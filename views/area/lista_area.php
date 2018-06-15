<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = 'LISTA DE AREAS';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="area-index">
    <div class="row">
        <div class="col-lg-12 col-md-8 col-sm-8 text-center">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
    </div>

    <div class="well">
        <div class="formulario-search">
            <br>
          <?php
          $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'action' => ['lista_area'],
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
        <div class="text-right">
          <?= Html::a('Registrar Area', ['area_insertar'], ['class' => 'btn btn-success ']) ?>
        </div>
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          'idarea',
          'nombre_area',
          'descripcion_area',
          ['class' => 'yii\grid\ActionColumn',
            'header' => 'OPCION',
            'template' => '{view} {update} {delete}',
            'buttons' => [
              'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model['idarea']]);
              },
              'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['area_modificar', 'id' => $model['idarea']]);
              },
              'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['area_eliminar', 'id' => $model['idarea']], [
                  'data' => [
                    'confirm' => 'Esta seguro de que quiere eliminar esta area?',
                  ],]);
              }
            ]
          ],
        ],
      ]); ?>
    </div>
</div>