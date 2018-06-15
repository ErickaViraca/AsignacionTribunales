<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'LISTA DE ROLES';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-index">

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
             <h3><?= Html::encode($this->title) ?></h3> 
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 text-right">     
            <br>
                 <?= Html::a('Registrar Rol', ['rol_insertar'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="well">
       <div class="formulario-search">
            <br>
            <?php
            $form = ActiveForm::begin([
                        'layout' => 'horizontal',
                        'action' => ['lista_usuario'],
                        'method' => 'get',
            ]);
            ?>
            <?= $form->field($model, 'palabraBuscar') ?>
            <div class="form-group text-center">

                <?=
                Html::submitButton('BUSCAR', [
                    'class' => 'btn btn',
                    'style' => 'width:250px; background-color: #959292;',

                ])
                ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="well">
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'idrol',
            'nombre_rol',
            'nombre_menu',

            ['class' => 'yii\grid\ActionColumn',
                'header' => 'OPCION',
                'template' => ' {update} {delete}',
                'buttons' => [
                    'update' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['rol_modificar', 'id' => $model['idrol'], 'id_rol' => $model['idmenu'], 'id_usr_rol'=>$model['idrol_menu']]);
                        },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['rol_eliminar', 'id' => $model['idrol']], [
                                    'data' => [
                                        'confirm' => 'Esta seguro de que quiere eliminar?',
                        ],]);}
                ]   
            ],
        ],
    ]); ?>
    </div>
    
</div>
