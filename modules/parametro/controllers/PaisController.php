<?php

namespace app\modules\parametro\controllers;

use Yii;
use app\modules\empleado\models\Empleado;
use app\modules\parametro\models\Pais;
use app\modules\parametro\models\PaisSearch;
use app\modules\parametro\models\SearchForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/**
 * 
 * PaisController implements the CRUD actions for Pais model.
 */
class PaisController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pais models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Pais model.
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
     * Creates a new Pais model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pais();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pais]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pais model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pais]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pais model.
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
     * Finds the Pais model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pais the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pais::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*
     * accion de redireccion vista de los activos 
     */
    public function actionActivo_pais(){
        return $this->renderAjax('view_activo_pais');
    }
    
        /*accion para obtener los dato de la base datos*/
    public function actionParam_pais_get(){
        $model = new Pais();
        $search= new SearchForm();
        if ($search->load(Yii::$app->request->get())&& $search->validate()) {
            $datos = $search->param_search_pais($search);
//            echo "hoal";
            return $this->render('view_get_pais', ['dataProvider' => $datos, 'model'=>$search]);
//           echo "<pre>";
//           print_r($searchModel);
//           echo "</pre>";
        }else{
        $datos=$model->param_pais_get();
        return $this->render('view_get_pais', ['dataProvider'=>$datos, 'model'=>$search]);
    }}
    /*
     * accion para insetar datos
     */
    public function actionPais_insert($submit=false){
       // $this->layout = false;
//        echo "hola";
//        die();
        $model = new Pais();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
        }
        if($model->load(Yii::$app->request->post())&& $model->validate()){
//            print_r($model);
//            die();
            if($model->param_pais_insert($model)){
                $model->refresh();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                'message' => '¡Éxito!',
            ];
            }else{
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->redirect(['param_pais_get', 'id' => $model->id_pais]);
            }
            
        }else{
            return $this->renderAjax('_form_insert', ['model'=>$model, 'bandera'=>'pais_insert']);
        }
    }
   /*
    * funciones action  
    */
    public function actionPais_add($submit=false){
//        $this->layout = false;
//        echo "hola";
//        die();
        $model = new Pais();
//        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
//        Yii::$app->response->format = Response::FORMAT_JSON;
//        return ActiveForm::validate($model);
//        }
        if($model->load(Yii::$app->request->post())){
//            print_r($model);
//            die();
            if($model->param_pais_insert($model)){
                $model->refresh();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                'message' => '¡Éxito!',
            ];
            }else{
//                $model->refresh();
//                $model = new Pais();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->redirect(['param_pais_get', 'id' => $model->id_pais]);
            }
            
        }else{
            return $this->renderAjax('_form_insert', ['model'=>$model]);
        }
    }
    /*
     * accion para actualizar datos al formulario
     * mediante los siguientes datos
     */

    public function actionParam_pais_update($id, $submit= false) {
       // $this->layout = false; 
       
        $model = $this->findModel($id);
//        $model->scenario = 'empleado';
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
//            print_r($model);
//            die();
             if($model->param_pais_update($model)){             
            $model->refresh();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->redirect(['param_pais_get', 'id' => $model->id_pais]);
            }else{
             Yii::$app->response->format = Response::FORMAT_JSON;             
             return ActiveForm::validate($model);
            }
        } else {
            return $this->renderAjax('_form_insert', [
                        'model' => $model,
                        'bandera'=>'param_pais_update'
            ]);
        }
    }
    /*
     * accion para eliminar datos al formulario
     */
    
    public function actionParam_pais_delete($id)
    {
        $model = new Pais();
        $model->param_pais_delete($this->findModel($id));
        return $this->redirect(['param_pais_get']);
         
    }
    public function actionEstado($id){
        $estado= $this->findModel($id);
        $estado->param_status_pais($estado);
        return $this->redirect(['param_pais_get']);
    }
    
    /*ACCION PARA EL REPORTE*/
    public function actionReporte_lista_pais(){
//        echo "oh";
//        die();
                
        Yii::setAlias('listaPais', 'reporte/param_pais');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@listaPais') . '/listaPais.jasper',
                    [],
                    ['pdf'],
                    false,
                    false
                
                )->execute();
//        echo "oh";
//        die();
                return $this->render('reporte_pais', [
                    'url'=>'reporte\param_pais\listaPais.pdf']);
//                return $this->render('reporte_pais', ['url'=>'reporte\param_pais\listaPais.xlsx']);
    
                
    }
    /*ACCION PARA EL REPORTE*/
    public function actionReporte_lista_pais_word(){
//        echo "oh";
//        die();
                
        Yii::setAlias('listaPais', 'reporte/param_pais');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@listaPais') . '/listaPais.jasper',
                    [],
                    ['docx'],
                    false,
                    false
                
                )->execute();
//        echo "oh";
//        die();
                return $this->render('reporte_pais', [
                    'url'=>'reporte\param_pais\listaPais.docx']);               
    }
    /*ACCION PARA EL REPORTE*/
    public function actionReporte_lista_pais_excel(){
//        echo "oh";
//        die();
                
        Yii::setAlias('listaPais', 'reporte/param_pais');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@listaPais') . '/listaPais.jasper',
                    [],
                    ['xls'],
                    false,
                    false
                
                )->execute();
//        echo "oh";
//        die();
                return $this->render('reporte_pais', [
                    'url'=>'reporte\param_pais\listaPais.xls']);               
    }
    /*ACCION PARA EL REPORTE*/
    public function actionReporte_lista_pais_point(){
//        echo "oh";
//        die();
                
        Yii::setAlias('listaPais', 'reporte/param_pais');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@listaPais') . '/listaPais.jasper',
                    [],
                    ['pptx'],
                    false,
                    false
                
                )->execute();
//        echo "oh";
//        die();
                return $this->render('reporte_pais', [
                    'url'=>'reporte\param_pais\listaPais.pptx']);               
    }
    /*ACCION PARA EL REPORTE*/
    public function actionDatos_pais($id_pais){
//        echo "oh";
//        die();
                
        Yii::setAlias('datosPais', 'reporte/param_pais');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@datosPais') . '/dato_pais.jasper',
                    ['id_pais'=> $id_pais],
                    ['pdf'],
                    false,
                    false
                
                )->execute();
//        echo "oh";
//        die();
                return $this->render('reporteDatosPais', ['url'=>'reporte\param_pais\dato_pais.pdf']);
    }
    /*
     * Accion para añadir una ciudad desde empleado  la  base de datos
     */
    public function actionAdd_form_emp_pais($submit= false)
    {
//        echo "hola";
//        die();
        $model = new Pais();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
        }
        if($model->load(Yii::$app->request->post())){
//            echo "hola";
//            die();
            if($model->param_pais_insert($model)){
//                $model->refresh();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                'message' => '¡Éxito!',
            ];
            }else{
                   
                $model->refresh();
//                Yii::$app->response->format = Response::FORMAT_JSON;
//                return $this->render('empleado/empleado/empleado_insert');
//                Yii::$app->response->redirect(['empleado/empleado/empleado_insert']);
//                return Yii::$app->response->redirect(Url::to(['empleado/empleado/empleado_insert', 'id' => $model->id_pais]));
//                echo "hola GENIAL";
//                die();
                $model = new Pais();
            }
            
        }else{
            return $this->renderAjax('_form_insert', ['model'=>$model, 'bandera'=>'add_form_emp_pais']);
        }
    }
    /**Controlador para obtener el pais añadido  recientemente**/
    public function actionParam_pais_get_nombre($nombre){
        
//        ECHO "HOLA";
//        DIE();
        $model= new Pais();
        $resultado=$model->param_pais_get_nombre($nombre);        
     }
}
