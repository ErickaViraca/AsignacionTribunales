<?php

namespace app\controllers;

use Yii;
use app\models\Rol;
use app\models\RoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Menu;
use app\models\RolMenu;
use app\models\BusquedaForm;
use yii\filters\AccessControl;

use yii\widgets\ActiveForm;
use yii\web\Response;

/**
 * RolController implements the CRUD actions for Rol model.
 */
class RolController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['rol_lista','rol_insertar','rol_modificar', 'rol_elminiar'],
                'rules' => [
                    [
                        'actions' => ['rol_lista','rol_insertar','rol_modificar', 'rol_elminiar'],
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
     * Lists all Rol models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rol model.
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
     * Creates a new Rol model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rol();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idrol]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rol model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idrol]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rol model.
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
     * Finds the Rol model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rol the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rol::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*registrar rol mas asignacion de menu*/
    public function actionRol_lista(){
        $model = new Rol();
        $search= new BusquedaForm();
       
        $dataProvider=$model->rol_lista();
        return $this->render('rol_lista', [
            'model' => $search,
            'dataProvider' => $dataProvider,
        ]);
    }
    /*registrar rol mas asignacion de menu*/
    public function actionRol_insertar(){
        $model = new Rol();
        $model_menu= Menu::getListaMenu();  
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
//                print_r($model);
//                die();
             
                if($model->insert()){
                   // alert("Hello! I am an alert box!!");
                    $model->find()->all();// para recuperar toda la informacion insertada
                        foreach($model->id_menu AS $menus){
                            $model_rol_menu= new RolMenu();
                            $model_rol_menu->rol_idrol= $model->idrol;
                            $model_rol_menu->menu_idmenu=$menus;
                                if($model_rol_menu->validate()){                             
                                    $model_rol_menu->insert();                         
                                } 
                        }
                return $this->redirect(['rol_lista', 'id' => $model->idrol]);
                }
            }else{
               
            }
        } else {
            return $this->render('rol_insertar', ['model' => $model, 'model_menu'=>$model_menu]);
        }
    }
    /*accion para modificar los datos del rol*/
    public function actionRol_modificar($id){
        $model = $this->findModel($id);
        $model_menu= Menu::getListaMenu(); 
        $model_rolMenu=RolMenu::listaRolMenu($id);
        foreach ($model_rolMenu as $nombreMenu){
            $idMenu[]= $nombreMenu['menu_idmenu'];
        }
        $model->id_menu= $idMenu;
//            echo"<pre>";
//            print_r($model);
//            echo"</pre>";
//            die(); 
        if ($model->load(Yii::$app->request->post())) {                      
            if($model->validate()){
                if($model->save()){

                   if($model->id_menu==$idMenu){
                       echo "solo entro aqui por algo no esta funcionando";
                   } else{
                       foreach ($model_rolMenu as $eliminarRolMenu){
                           RolMenu::rolMenu_eliminar($eliminarRolMenu['idrol_menu']);
                       }
                       foreach ($model->id_menu as $menu_id){
                           $model_rolMenu= new RolMenu();
                           $model_rolMenu->rol_idrol=$model->idrol;
                           $model_rolMenu->menu_idmenu=$menu_id;
                           if($model_rolMenu->validate()){
                               $model_rolMenu->insert();
                           }
                       }
                   }
                  
            return $this->redirect(['rol_lista', 'id' => $model->idrol]);
        }}}else {
        return $this->render('rol_modificar', [ 'model' => $model, 'model_menu'=>$model_menu]);
        }
    }
    /*procedimiento almacenado para eliminar datos en cascada*/
    public function actionRol_eliminar($id)
    {
        $model = new Rol();
        $model->rol_eliminar($this->findModel($id));
        return $this->redirect(['rol_lista']);
         
    }
}
