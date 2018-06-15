<?php

namespace app\modules\empleado\controllers;

use Yii;
use app\modules\empleado\models\Empleado;
use app\modules\empleado\models\EmpleadoSearch;
use app\modules\parametro\models\SearchForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\parametro\models\Ciudad;
use yii\helpers\Json;

use yii\web\UploadedFile;

/**
 * EmpleadoController implements the CRUD actions for Empleado model.
 */
class EmpleadoController extends Controller
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
     * Lists all Empleado models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpleadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Empleado model.
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
     * Creates a new Empleado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Empleado();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_empleado]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Empleado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_empleado]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Empleado model.
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
     * Finds the Empleado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empleado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empleado::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionEmpleado_get(){
        
        $model = new Empleado();
        $search= new SearchForm();
        if($search->load(Yii::$app->request->get())&& $search->validate()){
          $datos = $search->empleado_search($search);
            return $this->render('view_get_empleado', ['dataProvider' => $datos, 'model'=>$search]);
          
        }else{
            
        $datos=$model->empleado_get();
//        echo "hoa";
//        die();
        return $this->render('view_get_empleado', ['dataProvider'=>$datos, 'model'=>$search]);
    }}
    /*
     * prueba para ver si funciona ajax y mysql
     */
    public function actionPrueba($id_em){
      $model = new Empleado();
      $model->prueba($id_em);  
    }
    public function actionEmpleado_insert(){
        
        $model = new Empleado();
        if ($model->load(Yii::$app->request->post())) {
//            echo "<pre>";
//            print_r($model);
//            echo "</pre>";
//            die();
            $imagenes = UploadedFile::getInstance( $model , 'imagen' );
             $bytesCodificados = base64_encode(file_get_contents($imagenes->tempName));
             // echo '<img src="data:image/png;base64,'.$bytesCodificados.'"/>';
             $model->imagen = pg_escape_bytea($bytesCodificados);
             $model->foto=$model->imagen;
//             echo "<pre>";
//             print_r($model->foto);
//             echo "</pre>";
//             die();
            if( $model->empleado_insert($model)){
//                echo "hola";
//                die();
            return $this->redirect(['empleado_get', 'id' => $model->id_empleado]);
            }else {
                return $this->redirect(['empleado_get', 'id' => $model->id_empleado]);
//                var_dump($model->getErrors ()); die();
            }}
            return $this->render('_form_insert_empleado', [
                'model' => $model,
            ]);
        
    }
    public function actionEmpleado_update($id){
        
        $model = $this->findModel($id);
        $dato=$model->imagen;
        
        $ima=$model->empleado_prueba($id);
//        print_r($ima);
//        die();
      // echo '<img src="data:image/png;base64,'.$ima.'"/>';
        if ($model->load(Yii::$app->request->post())) {
            if(UploadedFile::getInstance( $model , 'imagen' )){
                 $imagenes = UploadedFile::getInstance( $model , 'imagen' );
             $bytesCodificados = base64_encode(file_get_contents($imagenes->tempName));
             $model->imagen = pg_escape_bytea($bytesCodificados);
            $model->empleado_update($model);
            return $this->redirect(['empleado_get', 'id' => $model->id_empleado]);
        
            }else{
              
            }
            $model->imagen= $ima;
            $model->empleado_update($model);
            return $this->redirect(['empleado_get', 'id' => $model->id_empleado]);
           } else {
              //echo $model->id_ciudad;
            
            $model->pais=30;
            $model->id_ciudad=22;
            return $this->render('_form_insert_empleado', [
                'model' => $model,
                'ima'=>$ima,
            ]);
        }
    }
    /*
     * accion para eliminar informacion de la base de datos 
     */
    public function actionEmpleado_delete($id)
    {
        $model = new Empleado();
        $model->empleado_delete($this->findModel($id));
        return $this->redirect(['empleado_get']);
         
    }
   
    
    /*
     * accion para actualizar los datos en empleado
     */
    public function actionParam_ciudad_update($id) {     
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
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
            ]);
        }
    }
    public function actionSub_ciudad(){
//        echo "hola mundo";
//        die();
        
        $out = [];
        $list=[];       
        if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        
        if ($parents != null) {
            $pais_id = $parents[0];
            $ciudades = Ciudad::param_get_ciudades_pais($pais_id);
            foreach ($ciudades as $ciudad){
              $list[]= ['id'=>$ciudad['id_ciudad'], 'name'=>$ciudad['nombre']];
              
            }
//            print_r($list);
//            die();
            echo Json::encode(['output'=>$list, 'SELECCION'=>'']);
            return;
        }
    }
    echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    /*ACCION PARA EL REPORTE POR PDF*/
    public function actionReporte_lista_empleado(){
        Yii::setAlias('lista', 'reporte/empleado');
        $titulo="hola";
        $jasper =Yii::$app->jasper;
        $jasper->process(
            Yii::getAlias('@lista') . '/listaGrupoEmpleado.jasper',
                    [],
                    ['pdf'],
                    false,
                    false
                
                )->execute();
                return $this->render('reporte', ['url'=>'reporte\empleado\listaGrupoEmpleado.pdf']);
    }
    /*ACCION PARA EL REPORTE POR WORD*/
    public function actionReporte_listas_empleado(){
//        echo "hola";
//        die();
        
        Yii::setAlias('lista', 'reporte/empleado');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@lista') . '/listaEmpleado.jasper',
                    [],
                    ['docx'],
                    false,
                    false
                
                )->execute();
//        echo "oh";
//        die();
                return $this->render('reporte', ['url'=>'reporte\empleado\listaGrupoEmpleado.docx']);
    }
    /*ACCION PARA EL REPORTE POR excel*/
    public function actionReporte_listas_empleados(){
//        echo "hola";
//        die();
        Yii::setAlias('lista', 'reporte/empleado');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@lista') . '/listaEmpleado.jasper',
                    [],
                    ['xlsx'],
                    false,
                    false
                
                )->execute();
//        echo "oh";
//        die();
                return $this->render('reporte', ['url'=>'reporte\empleado\listaGrupoEmpleado.xlsx']);
    }
    /*ACCION PARA EL REPORTE POR point*/
    public function actionReportes_listas_empleados(){
//        echo "hola";
//        die();
        Yii::setAlias('lista', 'reporte/empleado');
        $jasper =Yii::$app->jasper;
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@lista') . '/listaEmpleado.jasper',
                    [],
                    ['pptx'],
                    false,
                    false
                
                )->execute();
//        echo "oh";
//        die();
                return $this->render('reporte', ['url'=>'reporte\empleado\listaGrupoEmpleado.pptx']);
    }
    
//    public function actionReporteRoles() {
//\Yii::setAlias('dir', 'reportes/usuario');
//$jasper = \Yii::$app->jasper;
//$jasper->process(Yii::getAlias('@dir') . '/report_rols.jasper', [], ['pdf', 'xlsx'], false, false)->execute();
//return $this->render('reporte', ['url' => \Yii::getAlias('@dir') . '/report_rols.pdf']);
//}
    /*ACCION PARA EL REPORTE CIUDAD PDF*/
    public function actionEmpleado_dato($id){
           
        Yii::setAlias('empleadoDato', 'reporte/empleado');
        $jasper =Yii::$app->jasper;
      
               
        //$jasper->compile(Yii::getAlias('@nombre_cualquiera'). 'getLista.jrxml')->excute();
        $jasper->process(
            Yii::getAlias('@empleadoDato') . '/empleado_id.jasper',
                    ['id_empleado'=> $id],
                    ['pdf'],
                    false,
                    false 
                )->execute();
//        echo "genial";
//        die();
                return $this->render('reporteEmpleadoDato', ['url'=>'reporte\empleado\empleado_id.pdf']);
    }
    /*ACCION PARA EL REPORTE CIUDAD WORD*/
    public function actionEmpleados_datos($id){
           
        Yii::setAlias('empleadoDato', 'reporte/empleado');
        $jasper =Yii::$app->jasper;       
        $jasper->process(
            Yii::getAlias('@empleadoDato') . '/empleado_id.jasper',
                    ['id_empleado'=> $id],
                    ['pdf'],
                    false,
                    false 
                )->execute();
                return $this->render('reporteEmpleadoDato', ['url'=>'reporte\empleado\empleado_id.docx']);
    }
    
    
}
