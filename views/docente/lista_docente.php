<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = 'LISTA DE DOCENTES';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="docente-index">
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
            'action' => ['lista_docente'],
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
          <?= Html::a('Registrar Docente', ['docente_insertar'], ['class' => 'btn btn-success ']) ?>
        </div>
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          'nombre_doc',
          'paterno_doc',
          'materno_doc',
          'titulo_doc',
          'carga_horaria_doc',
          ['class' => 'yii\grid\ActionColumn',
            'header' => 'OPCION',
            'template' => '{view} {update} {delete}',
            'buttons' => [
              'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model['iddocente']]);
              },
              'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['modificar', 'id' => $model['iddocente']]);
              },
              'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['docente_eliminar', 'id' => $model['iddocente']], [
                  'data' => [
                    'confirm' => 'Esta seguro de que quiere eliminar este profesional?',
                  ],]);
              }
            ]
          ],
        ],
      ]); ?>
    </div>
</div>