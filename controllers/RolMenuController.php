<?php

namespace app\controllers;

use Yii;
use app\models\RolMenu;
use app\models\RolMenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RolMenuController implements the CRUD actions for RolMenu model.
 */
class RolMenuController extends Controller
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
     * Lists all RolMenu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RolMenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RolMenu model.
     * @param integer $idrol_menu
     * @param integer $rol_idrol
     * @param integer $menu_idmenu
     * @return mixed
     */
    public function actionView($idrol_menu, $rol_idrol, $menu_idmenu)
    {
        return $this->render('view', [
            'model' => $this->findModel($idrol_menu, $rol_idrol, $menu_idmenu),
        ]);
    }

    /**
     * Creates a new RolMenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RolMenu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idrol_menu' => $model->idrol_menu, 'rol_idrol' => $model->rol_idrol, 'menu_idmenu' => $model->menu_idmenu]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RolMenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idrol_menu
     * @param integer $rol_idrol
     * @param integer $menu_idmenu
     * @return mixed
     */
    public function actionUpdate($idrol_menu, $rol_idrol, $menu_idmenu)
    {
        $model = $this->findModel($idrol_menu, $rol_idrol, $menu_idmenu);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idrol_menu' => $model->idrol_menu, 'rol_idrol' => $model->rol_idrol, 'menu_idmenu' => $model->menu_idmenu]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RolMenu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idrol_menu
     * @param integer $rol_idrol
     * @param integer $menu_idmenu
     * @return mixed
     */
    public function actionDelete($idrol_menu, $rol_idrol, $menu_idmenu)
    {
        $this->findModel($idrol_menu, $rol_idrol, $menu_idmenu)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RolMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idrol_menu
     * @param integer $rol_idrol
     * @param integer $menu_idmenu
     * @return RolMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idrol_menu, $rol_idrol, $menu_idmenu)
    {
        if (($model = RolMenu::findOne(['idrol_menu' => $idrol_menu, 'rol_idrol' => $rol_idrol, 'menu_idmenu' => $menu_idmenu])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
