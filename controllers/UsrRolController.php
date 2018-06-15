<?php

namespace app\controllers;

use Yii;
use app\models\UsrRol;
use app\models\UsrRolSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsrRolController implements the CRUD actions for UsrRol model.
 */
class UsrRolController extends Controller
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
     * Lists all UsrRol models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsrRolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsrRol model.
     * @param integer $idusr_rol
     * @param integer $usuario_idusuario
     * @param integer $rol_idrol
     * @return mixed
     */
    public function actionView($idusr_rol, $usuario_idusuario, $rol_idrol)
    {
        return $this->render('view', [
            'model' => $this->findModel($idusr_rol, $usuario_idusuario, $rol_idrol),
        ]);
    }

    /**
     * Creates a new UsrRol model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsrRol();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idusr_rol' => $model->idusr_rol, 'usuario_idusuario' => $model->usuario_idusuario, 'rol_idrol' => $model->rol_idrol]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UsrRol model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idusr_rol
     * @param integer $usuario_idusuario
     * @param integer $rol_idrol
     * @return mixed
     */
    public function actionUpdate($idusr_rol, $usuario_idusuario, $rol_idrol)
    {
        $model = $this->findModel($idusr_rol, $usuario_idusuario, $rol_idrol);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idusr_rol' => $model->idusr_rol, 'usuario_idusuario' => $model->usuario_idusuario, 'rol_idrol' => $model->rol_idrol]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UsrRol model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idusr_rol
     * @param integer $usuario_idusuario
     * @param integer $rol_idrol
     * @return mixed
     */
    public function actionDelete($idusr_rol, $usuario_idusuario, $rol_idrol)
    {
        $this->findModel($idusr_rol, $usuario_idusuario, $rol_idrol)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UsrRol model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idusr_rol
     * @param integer $usuario_idusuario
     * @param integer $rol_idrol
     * @return UsrRol the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idusr_rol, $usuario_idusuario, $rol_idrol)
    {
        if (($model = UsrRol::findOne(['idusr_rol' => $idusr_rol, 'usuario_idusuario' => $usuario_idusuario, 'rol_idrol' => $rol_idrol])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
