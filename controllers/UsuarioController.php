<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//aqui se va añadiendo
use yii\widgets\ActiveForm;
use yii\web\Response;
use app\models\UsrRol;
use app\models\BusquedaForm;
use yii\filters\AccessControl;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['lista_usuario','usuario_insertar','usuario_modificar', 'usuario_elminiar'],
                'rules' => [
                    [
                        'actions' => ['lista_usuario','usuario_insertar','usuario_modificar', 'usuario_elminiar'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuario();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idusuario]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idusuario]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*
     * @ desde aqui se realizan los cambios con procedimiento almacenado
     */
    public function actionLista_usuario(){
        $model = new Usuario();
        $search= new BusquedaForm();
        if($search->load(Yii::$app->request->get())&& $search->validate()){
          $datos = $search->usuario_busqueda($search);
            return $this->render('lista_usuario', ['dataProvider' => $datos, 'model'=>$search]);
        }else{
        $datos=$model->lista_usuario();
        return $this->render('lista_usuario', [            
            'dataProvider' => $datos,'model'=>$search
        ]);
    }}

    public function actionUsuario_estado($id){
        $model= $this->findModel($id);
        $model->usuario_estado($model);
        return $this->redirect(['lista_usuario']);
    }
    /*
     * @ desde aqui se realizan los cambios con procedimiento almacenado
     */
    public function actionUsuario_insertar()
    {
        $model = new Usuario();
        $model_usr_rol = new UsrRol();
        $mensaje= null;
        /*validar con ajax*/
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) 
        {          
          if($model->validate()){
                $model->activate=0;                
                $model->contrasenia = crypt($model->contrasenia, Yii::$app->params["salt"]);
                $model->conf_contrasenia = $this->randKey("abcdef0123456789", 20);
                $model->accessToken = $this->randKey("abcdef0123456789", 20);
                if($model->usuario_insertar($model)){
                    $mensaje = "Ha ocurrido un error al llevar a cabo tu registro";
                }else{
                   
                    $user = $model->find()->where(["correo_usr" => $model->correo_usr])->one();
                   /* echo"<pre>";
                    print_r($user);
                    echo"</pre>";
                    die();*/
                    $id = urlencode($user->idusuario);
                    $conf_contrasenia = urlencode($user->conf_contrasenia);
                    $subject = "Confirmar registro";
                    $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
                    $body .= "<a href='http://asignacionTribunal/index.php?r=site/confirm&id=".$id."&authKey=".$conf_contrasenia."'>Confirmar</a>";
                    Yii::$app->mailer->compose()
                    ->setTo($user->correo_usr)
                    ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
                    ->setSubject($subject)
                    ->setHtmlBody($body)
                    ->send();
                    $model_usr_rol->usuario_idusuario= $user->idusuario;
                    $model_usr_rol->rol_idrol=$model->id_rol;
                    $model_usr_rol->insert();
                    return $this->redirect(['lista_usuario', 'id' => $model->idusuario]);
                    }  
          }else{
              $model->getErrors();
          }
        }
        return $this->render('usuario_insertar', ['model' => $model, 'mensaje'=>$mensaje]);
    }
    /*esta funcion se encarga de crear claves aleatoria mandando como parametro*/
    private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
    /*para ver el formulario*/
    public function actionModificar($id, $id_rol, $id_usr_rol)
    {
        $model = $this->findModel($id);
        $model->id_rol=$id_rol;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idusuario]);
        } else {
            return $this->render('modificar', [
                'model' => $model,
            ]);
        }
    }
    /*
     * accion para eliminar informacion de la base de datos 
     */
    public function actionUsuario_eliminar($id)
    {
        $model = new Usuario();
        $model->usuario_eliminar($this->findModel($id));
        return $this->redirect(['lista_usuario']);
    }
}
