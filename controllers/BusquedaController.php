<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
//use Yii;
use yii\web\Controller;

use yii\filters\VerbFilter;
use app\models\BusquedaForm;
//use app\models\BusquedaForm;
/**
 * Description of BusquedaController
 *
 * @author MIS DOCUMENTOS
 */
class BusquedaController extends Controller{
    //put your code here
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
    public function actionBusqueda()
    {
        $search= new BusquedaForm();
        $datos= $search->obtenerRegProy(1);
        echo "<pre>";
        print_r($datos);
        echo "</pre>";
        die();
        return $this->render('busqueda');
    }
}
