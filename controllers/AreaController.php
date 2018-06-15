<?php
/**
 * Created by PhpStorm.
 * User: romane
 * Date: 04/06/2018
 * Time: 01:10 AM
 */

namespace app\controllers;

use app\models\Area;
use app\models\AreaSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;
use app\models\BusquedaForm;
use yii\filters\AccessControl;

/**
 * DocenteController implements the CRUD actions for Docente model.
 */
class AreaController extends Controller
{
  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'only' => ['lista_area', 'area_insertar', 'area_modificar', 'area_eliminar'],
        'rules' => [
          [
            'actions' => ['lista_area', 'area_insertar', 'area_modificar', 'area_eliminar'],
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
   * Lists all Area models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new AreaSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single Docente model.
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
   * Updates an existing Area model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->idarea]);
    } else {
      return $this->render('update', [
        'model' => $model,
      ]);
    }
  }

  /**
   * Deletes an existing Area model.
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
   * Finds the Docente model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Area
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Area::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

  public function actionLista_area()
  {
    $model = new Area();
    $search = new BusquedaForm();
    if ($search->load(Yii::$app->request->get()) && $search->validate()) {
      $datos = $search->area_busqueda($search);
      return $this->render('lista_area', ['dataProvider' => $datos, 'model' => $search]);
    } else {
      $datos = $model->lista_area();
      return $this->render('lista_area', [
        'dataProvider' => $datos, 'model' => $search
      ]);
    }
  }


  public function actionArea_insertar()
  {
    $model = new Area();
    $mensaje = null;
    /*validar con ajax*/
    if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
      Yii::$app->response->format = Response::FORMAT_JSON;
      return ActiveForm::validate($model);
    }
    if ($model->load(Yii::$app->request->post())) {
      if ($model->validate()) {
        if ($model->area_insertar($model)) {
          $mensaje = "Ha ocurrido un error al llevar a cabo tu registro";
        } else {
          return $this->redirect(['lista_area', 'id' => $model->idarea]);
        }
      } else {
        $model->getErrors();
      }
    }
    return $this->render('area_insertar', ['model' => $model, 'mensaje' => $mensaje]);
  }

  public function actionArea_modificar($id)
  {
    $model = $this->findModel($id);
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->idarea]);
    } else {
      return $this->render('modificar_area', [
        'model' => $model,
      ]);
    }
  }

  public function actionArea_eliminar($id)
  {
    $model = new Area();
    $model->area_eliminar($this->findModel($id));
    return $this->redirect(['lista_area']);
  }
}