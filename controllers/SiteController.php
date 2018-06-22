<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\BusquedaForm;
use app\models\TribunalForm;
use app\models\AsignacionRegistroForm;
use app\models\RegAsigTri;
use app\models\Proyecto;
use yii\web\Response;
use yii\widgets\ActiveForm;

use app\models\Docente;

class SiteController extends Controller
{
  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'only' => ['logout'],
        'rules' => [
          [
            'actions' => ['logout'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'logout' => ['post'],
        ],
      ],
    ];
  }

  /**
   * @inheritdoc
   */
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
      'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
      ],
    ];
  }

  /**
   * Displays homepage.
   *
   * @return string
   */
  public function actionIndex()
  {
    $model = new BusquedaForm();
    if ($model->load(Yii::$app->request->post())) {
      //echo $model->palabraBuscar;
      $resul_bus = $model->busqueda_titulo($model->palabraBuscar);
      //die();
      return $this->render('index', ['model' => $model, 'titulo_proyectos' => $resul_bus]);
    } else {
      $titulo_proyectos = $model->busqueda_proyecto();
      return $this->render('index', ['model' => $model, 'titulo_proyectos' => $titulo_proyectos]);
    }
  }

  /**mos trar datos del estudiante
   */
  public function actionInfo_estu($id_estudiante)
  {
    $model = new BusquedaForm();
    $rescate_id_estu = $model->datos_estu_proy($id_estudiante);
    //$rescate_id_estu = $model->rescate_datos_estu($id_estudiante);
    return $this->render('info_estu', ['rescate_id_estu' => $rescate_id_estu, 'model' => $model]);

  }

  /**
   * Login action.
   *
   * @return string
   */
  public function actionLogin()
  {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    }
    return $this->render('login', [
      'model' => $model,
    ]);
  }

  /**
   * Logout action.
   *
   * @return string
   */
  public function actionLogout()
  {
    Yii::$app->user->logout();

    return $this->goHome();
  }

  /**
   * Displays contact page.
   *
   * @return string
   */
  public function actionContact()
  {
    $model = new ContactForm();
    if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
      Yii::$app->session->setFlash('contactFormSubmitted');

      return $this->refresh();
    }
    return $this->render('contact', [
      'model' => $model,
    ]);
  }

  /**
   * Displays about page.
   *
   * @return string
   */
  public function actionAbout()
  {
    return $this->render('about');
  }

  /**
   * Displays about page.
   * para aprobar temas y asignar titulos
   */
  public function actionAprobacion_titulo()
  {

    $model = new BusquedaForm();
    if ($model->load(Yii::$app->request->post())) {
      //echo $model->palabraBuscar;
      $resul_bus = $model->designar_tribunales($model->palabraBuscar);
      //print_r($resul_bus);
      //die();
      return $this->render('aprobacion_titulo', ['model' => $model, 'titulo_aprobado' => $resul_bus]);
    } else {
      $titulo_aprobado = $model->lista_para_aprobar_titulo();
      return $this->render('aprobacion_titulo', ['model' => $model, 'titulo_aprobado' => $titulo_aprobado]);
    }
  }

  public function actionEnviar_tribunales($id, $opcion)
  {
    $model = new BusquedaForm();
    $enviar = $model->enviar_tribunales($id, $opcion);
    return $this->redirect(['aprobacion_titulo']);
    //print_r($enviar);
    //die();
  }
  /**
   * Displays about page.
   *lista para asignar tribunales segun areas
   */
  /*public function actionSegun_area()
  {
      $model = new TribunalForm();
      if ($model->load(Yii::$app->request->post())) {
          $lista_tutor = $model->lista_tutor($model->lista_titulo);
          $lista_estudiante = $model->lista_estudiante($model->lista_titulo);
          return $this->render('segun_area', ['model'=>$model, 'lista_tutor'=>$lista_tutor, 'lista_estudiante'=>$lista_estudiante]);
      } else {
         $lista_tutor=array();
         $lista_estudiante=array();
         return $this->render('segun_area',['model'=>$model,'lista_tutor'=>$lista_tutor, 'lista_estudiante'=>$lista_estudiante]);
      }

  }*/
  public function actionSegun_area()
  {
    $model = new TribunalForm();
    if ($model->load(Yii::$app->request->post())) {
      $bandera = $model->lista_titulo;
      $lista_tutor = $model->lista_tutor($model->lista_titulo);
      $lista_estudiante = $model->lista_estudiante($model->lista_titulo);
      return $this->render('segun_area', ['model' => $model, 'lista_tutor' => $lista_tutor, 'lista_estudiante' => $lista_estudiante, 'bandera' => $bandera]);
    } else {
      $bandera = "";
      $lista_tutor = array();
      $lista_estudiante = array();
      return $this->render('segun_area', ['model' => $model, 'lista_tutor' => $lista_tutor, 'lista_estudiante' => $lista_estudiante, 'bandera' => $bandera]);
    }
  }

  public function actionLista_profesionales($id_titulo)
  {
    $model = new AsignacionRegistroForm();
    if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
      Yii::$app->response->format = Response::FORMAT_JSON;
      return ActiveForm::validate($model);
    }
    if ($model->load(Yii::$app->request->post())) {
      $model->id_titulo = $id_titulo;
      $model->id_docente = $_POST['mischecks'];
      if ($model->validate()) {
        $titulo_estu = $model->getListaTitu_estu($id_titulo);
        $model->asignarCantidad($model->id_docente);
        $model->estadoTituloConcluido($id_titulo);
        foreach ($model->id_docente as $docente) {

          foreach ($titulo_estu as $id_titulo_estu) {
            $model_rat = new RegAsigTri();
            $model_rat->fecha_registro_asig = $model->fecha_registro;
            $model_rat->pro_estu_idpro_estu = $id_titulo_estu['idpro_estu'];
            $model_rat->pro_estu_proyecto_idproyecto = $id_titulo;
            $model_rat->pro_estu_estudiante_idestudiante = $id_titulo_estu['estudiante_idestudiante'];
            $model_rat->docente_iddocente = $docente;
            if ($model_rat->validate()) {
              $model_rat->insert();
              $model->enviarEmailDocente($docente);
            }
          }
        }
        return $this->redirect(['vista_asignacion', 'id_titulo' => $id_titulo]);
      }
    } else {
      return $this->render('lista_profesionales', ['model' => $model, 'id_titulo' => $id_titulo]);
    }
  }
  /*
   * Asignar cantidad a los tribunales
   */
  /*public function asignarCantidad($docente){
      echo $docente;
  }*/

  /*
   * vista de asignacion de tribunales
   */
  public function actionVista_asignacion($id_titulo)
  {
    $model = new AsignacionRegistroForm();
    $model_prof = $model->lista_profe_asignados($id_titulo);
    $model_estu = $model->lista_estu_asignados($id_titulo);
    $model_titulo = $model->lista_titulo_asignados($id_titulo);

    return $this->render('vista_asignacion', ['model_prof' => $model_prof, 'model_estu' => $model_estu, 'model_titulo' => $model_titulo]);
  }

  public function actionAsignacion_registro()
  {

    return $this->render('asignacion_registro');
  }

  /*lista de de profesionales con cargo de estudiantes*/
  public function actionProfecional_cargo_estu()
  {
    $model = new BusquedaForm();
    if ($model->load(Yii::$app->request->post())) {
      $cantidadEstuProf = BusquedaForm::busqueda_nombre_doc($model);
      return $this->render('profecional_cargo_estu', ['model' => $model, 'dataProvider' => $cantidadEstuProf]);
    } else {
      $cantidadEstuProf = AsignacionRegistroForm::listaDocenteCantidad();
      //print_r($cantidadEstuProf );
      return $this->render('profecional_cargo_estu', ['dataProvider' => $cantidadEstuProf, 'model' => $model,]);
    }
  }

  /*lista de areas de pertinencia*/
  public function actionProfecional_area_p()
  {
    //$model_usuario = new AsignacionRegistroForm();
    $model = new BusquedaForm();
    if ($model->load(Yii::$app->request->get())) {
      $listaArea = $model->busqueda_area($model);
      return $this->render('profecional_area_p', ['dataProvider' => $listaArea, 'model' => $model]);
    } else {
      $listaArea = AsignacionRegistroForm::listaArea();

      return $this->render('profecional_area_p', ['dataProvider' => $listaArea, 'model' => $model]);
    }
  }

  public function actionSend($to)
  {
    $from = 'tis.umss.2018@gmail.com';
    $subject = 'Assignment T - FCyT';
    $body = 'Usted fue asignado como tribunal';
    //try {
    Yii::$app->mailer->compose()
      ->setFrom($from)
      ->setTo($to)
      ->setSubject($subject)
      ->setTextBody('Sent From APP_WEB')
      ->setHtmlBody($body)
      ->send();

    /*$message = Yii::$app->mailer->compose();
    if (!Yii::$app->user->isGuest) {
      $message->setFrom(Yii::$app->user->identity->email);
    }
    $message->setTo(Yii::$app->params['evDev02@gmail.com'])
      ->setSubject('EMAIL CORREO YII')
      ->setTextBody('CORREO FUNCIONAAAAAAAAAA')
      ->send();*/

    /*return $this->render('sent_message', ['from' => $from, 'to' => $to, 'subject' => $subject, 'body' => $body]);
  } catch (\Swift_TransportException $exception) {
    return $this->render('notsend_message', ['from' => $from, 'to' => $to, 'subject' => $subject, 'body' => $body]);
  }*/
  }

}
