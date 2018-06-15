<?php

namespace app\modules\parametro\controllers;

use Yii;
use app\modules\parametro\models\Ciudad;
use app\modules\parametro\models\CiudadSearch;
use app\modules\parametro\models\SearchForm;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\Response;

use yii\widgets\ActiveForm;
/**
 * CiudadController implements the CRUD actions for Ciudad model.
 */
class CiudadController extends Controller
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
     * Lists all Ciudad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CiudadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ciudad model.
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
     * Creates a new Ciudad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ciudad();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_ciudad]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ciudad model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_ciudad]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ciudad model.
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
     * Finds the Ciudad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ciudad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ciudad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*accion para obtener los dato de la base datos*/
    public function actionParam_ciudad_get(){
        $model= new Ciudad();
        $search= new SearchForm();
        if($search->load(Yii::$app->request->get())&& $search->validate()){
            $datos = $search->param_ciudad_search($search);
            return $this->render('view_get_ciudad', ['dataProvider' => $datos, 'model'=>$search]);
        }else{
        $datos=$model->param_ciudad_get();
        return $this->render('view_get_ciudad',['dataProvider'=>$datos, 'model'=>$search]);
    }}
    /*
     * accion para insetar datos
     */
    public function actionCiudad_insert($submit=false){
        //$this->layout = false;
        $model = new Ciudad();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
        }
        if($model->load(Yii::$app->request->post())&& $model->validate()){
//            echo "<pre>";
//            print_r($model);
//            echo "</pre>";
//            die();
            if($model->param_ciudad_insert($model)){
                $model->refresh();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                'message' => '¡Éxito!',
            ];
            }else{
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->redirect(['param_ciudad_get', 'id' => $model->id_ciudad]);
            }
            
        }else{
            return $this->renderAjax('_form_insert_ciudad', ['model'=>$model, 'bandera'=>'ciudad_insert']);
        }
    }
     /*accion de actualizar*/
    public function actionParam_ciudad_update($id, $submit= false) {
//        $this->layout = false; 
       
        $model = $this->findModel($id);
//        echo "<pre>";
//        print_r($model);
//        echo "</pre>";
//        die();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
//            print_r($model);
//            die();
             if($model->param_ciudad_update($model)){             
            $model->refresh();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->redirect(['param_ciudad_get', 'id' => $model->id_ciudad]);
            }else{
             Yii::$app->response->format = Response::FORMAT_JSON;             
             return ActiveForm::validate($model);
            }
        } else {
            return $this->renderAjax('_form_insert_ciudad', [
                        'model' => $model,
                        'bandera'=>'param_ciudad_update'
            ]);
        }
    }
    /*
     * accion para eliminar datos al formulario
     */
    
    public function actionParam_ciudad_delete($id)
    {
        $model = new Ciudad();
        $model->param_ciudad_delete($this->findModel($id));
        return $this->redirect(['param_ciudad_get']);
         
    }
    /*
     * accion para cambiar el estado de la ciudad
     */
    public function actionEstado_ciudad($id){
        $model= $this->findModel($id);
        $model->param_status_ciudad($model);
        return $this->redirect(['param_ciudad_get']);
    }
    /*
     * reporte para sacar lista de la ciudad pdf  
     */
    public function actionReporte_lista_ciudad(){
//                echo "oh";
//        die();
                
        Yii::setAlias('listaCiudad', 'reporte/param_ciudad');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@listaCiudad') . '/agruparListaCiudad.jasper',
                    [],
                    ['pdf'],
                    false,
                    false
                
                )->execute();
//        echo "genial";
//        die();
                return $this->render('reporte_lista_ciudad', ['url'=>'reporte\param_ciudad\agruparListaCiudad.pdf', 'formato'=>'pdf']);
    
    }
    /*
     * prueba  con word
     */
    
    public function actionReporte_listas_ciudad(){
//                echo "oh";
//        die();
                
        Yii::setAlias('listaCiudad', 'reporte/prueba');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@listaCiudad') . '/ciudadLista.jasper',
                    [],
                    ['docx'],
                    false,
                    false
                
                )->execute();
//        echo "genial";
//        die();
                return $this->render('reporte_lista_ciudad', ['url'=>'reporte\prueba\ciudadLista.docx', 'formato'=>'word']);
    
    }
     /*
     * prueba  con excel
     */
    
    public function actionReporte_listas_ciudades(){
//                echo "oh";
//        die();
                
        Yii::setAlias('listaCiudad', 'reporte/prueba');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@listaCiudad') . '/ciudadLista.jasper',
                    [],
                    ['xls'],
                    false,
                    false
                
                )->execute();
//        echo "genial";
//        die();
                return $this->render('reporte_lista_ciudad', ['url'=>'reporte\prueba\ciudadLista.xls', 'formato'=>'excel']);
    
    }
    /*
     * formato point 
     */
    public function actionReportes_listas_ciudades(){
//                echo "oh";
//        die();
                
        Yii::setAlias('listaCiudad', 'reporte/prueba');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@listaCiudad') . '/ciudadLista.jasper',
                    [],
                    ['pptx'],
                    false,
                    false
                
                )->execute();
//        echo "genial";
//        die();
                return $this->render('reporte_lista_ciudad', ['url'=>'reporte\prueba\ciudadLista.pptx', 'formato'=>'point']);
    
    }
    
    /*ACCION PARA EL REPORTE CIUDAD PDF*/
    public function actionDatos_ciudad($id_ciudad){
//        echo "oh";
//        die();
                
        Yii::setAlias('datosCiudad', 'reporte/param_ciudad');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@datosCiudad') . '/datoCiudad.jasper',
                    ['id_ciudad'=> $id_ciudad],
                    ['pdf'],
                    false,
                    false
                
                )->execute();
//        echo "genial";
//        die();
                return $this->render('reporteDatosCiudad', ['url'=>'reporte\param_ciudad\datoCiudad.pdf']);
    }
       /*ACCION PARA EL REPORTE CIUDAD PDF*/
    public function actionDato_ciudad($id_ciudad){
//        echo "oh";
//        die();
                
        Yii::setAlias('datosCiudad', 'reporte/param_ciudad');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@datosCiudad') . '/datoCiudad.jasper',
                    ['id_ciudad'=> $id_ciudad],
                    ['docx'],
                    false,
                    false
                
                )->execute();
//        echo "genial";
//        die();
                return $this->render('reporteDatosCiudad', ['url'=>'reporte\param_ciudad\datoCiudad.docx']);
    }
    /*ACCION PARA EL REPORTE CIUDAD  para WORD*/
 
    /*ACCION PARA EL REPORTE CIUDAD  para PDF*/
    public function actionCiudades_datos($id_ciudad){
//        echo "oh";
//        die();
                
        Yii::setAlias('datosCiudad', 'reporte/prueba');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@datosCiudad') . '/datosCiudad.jasper',
                    ['id_ciudad'=> $id_ciudad],
                    ['xls'],
                    false,
                    false        
                )->execute();
//        echo "genial";
//        die();
                return $this->render('reporteDatosCiudad', ['url'=>'reporte\prueba\datosCiudad.xls']);
    }
    /*
     * accion para insetar datos para actualizar datos desde el formulario empleado
     */
    public function actionCiudad_insert_emp($submit=false){
        //$this->layout = false;
        $model = new Ciudad();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
        }
        if($model->load(Yii::$app->request->post())&& $model->validate()){
//            echo "<pre>";
//            print_r($model);
//            echo "</pre>";
//            die();
            if($model->param_ciudad_insert($model)){
                $model->refresh();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                'message' => '¡Éxito!',
            ];
            }else{
                //Yii::$app->response->format = Response::FORMAT_JSON;
                $model->refresh();
                $model = new Ciudad();
            
//            return $this->redirect(['param_ciudad_get', 'id' => $model->id_ciudad]);
            }
            
        }else{
            return $this->renderAjax('_form_insert_ciudad', ['model'=>$model, 'bandera'=>'ciudad_insert']);
        }
    }
    /**Controlador para obtener el pais añadido  recientemente**/
    public function actionParam_ciudad_get_nombre($nombre){
        
//        ECHO "HOLA";
//        DIE();
        $model= new Ciudad();
        $resultado=$model->param_ciudad_get_nombre($nombre);        
     }
}
