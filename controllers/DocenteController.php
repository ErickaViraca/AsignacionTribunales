<?php
/**
 * Created by PhpStorm.
 * User: romane
 * Date: 04/06/2018
 * Time: 01:10 AM
 */

namespace app\controllers;

use Yii;
use app\models\Docente;
use app\models\DocenteSearch;
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
class DocenteController extends Controller
{
  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'only' => ['lista_docente', 'docente_insertar', 'docente_modificar', 'docente_elminiar'],
        'rules' => [
          [
            'actions' => ['lista_docente', 'docente_insertar', 'docente_modificar', 'docente_elminiar'],
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
   * Lists all Docente models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new DocenteSearch();
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
   * Creates a new Docente model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Docente();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->iddocente]);
    } else {
      return $this->render('create', [
        'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing Docente model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->iddocente]);
    } else {
      return $this->render('update', [
        'model' => $model,
      ]);
    }
  }

  /**
   * Deletes an existing Docente model.
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
   * @return Docente the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Docente::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }


  public function actionLista_docente()
  {
    $model = new Docente();
    $search = new BusquedaForm();
    if ($search->load(Yii::$app->request->get()) && $search->validate()) {
      $datos = $search->docente_busqueda($search);
      return $this->render('lista_docente', ['dataProvider' => $datos, 'model' => $search]);
    } else {
      $datos = $model->lista_docente();
      return $this->render('lista_docente', [
        'dataProvider' => $datos, 'model' => $search
      ]);
    }
  }


  public function actionDocente_insertar()
  {
    $model = new Docente();
    $mensaje = null;
    /*validar con ajax*/
    if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
      Yii::$app->response->format = Response::FORMAT_JSON;
      return ActiveForm::validate($model);
    }
    if ($model->load(Yii::$app->request->post()))
    {
      if ($model->validate()) {
        if ($model->docente_insertar($model)) {
          $mensaje = "Ha ocurrido un error al llevar a cabo tu registro";
          }
          else {
          return $this->redirect(['lista_docente', 'id' => $model->iddocente]);
        }
      } else {
        $model->getErrors();
      }
    }
    return $this->render('docente_insertar', ['model' => $model, 'mensaje' => $mensaje]);
  }

  /*para ver el formulario*/
  public function actionModificar($id)
  {
    $model = $this->findModel($id);
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->iddocente]);
    } else {
      return $this->render('modificar', [
        'model' => $model,
      ]);
    }
  }

  public function actionDocente_eliminar($id)
  {
    $model = new Docente();
    $model->docente_eliminar($this->findModel($id));
    return $this->redirect(['lista_docente']);
  }
}
