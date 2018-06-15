<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'LISTA DE USUARIOS';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="usuario-index">
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
            'action' => ['lista_usuario'],
            'method' => 'get',
          ]);
          ?>
          <?= $form->field($model, 'palabraBuscar') ?>
            <div class="form-group text-center">
              <?= Html::submitButton('BUSCAR', [
                'class' => 'btn btn',
                'style' => 'width:250px; background-color: #959292;',
              ]) ?>
            </div>
          <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="well">
        <div class="text-right">
          <?= Html::a('Registrar Usuario', ['usuario_insertar'], ['class' => 'btn btn-success ']) ?>
        </div>
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
          ['class' => 'yii\grid\SerialColumn'],
          'nombre_usr',
          'correo_usr',
          'nombre_rol',
          'activate',
          ['class' => 'yii\grid\ActionColumn',
            'header' => 'ESTADO',
            'template' => '{estado}',
            'buttons' => [
              'estado' => function ($url, $model) {
                if ($model['activate'] == 1) {
                  return Html::a('Activado', $url, ['title' => 'desactivar']);
                } else {
                  return Html::a('Desactivado', $url, ['title' => 'Activar']);
                }
              }],
            'urlCreator' => function ($action, $model) {
              if ($action == 'estado') {
                return Url::to(['usuario_estado', 'id' => $model['idusuario']]);
              }
            }
          ],
          ['class' => 'yii\grid\ActionColumn',
            'header' => 'OPCION',
            'template' => '{view} {update} {delete}',
            'buttons' => [
              'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model['idusuario']]);
              },
              'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['modificar', 'id' => $model['idusuario'], 'id_rol' => $model['idrol'], 'id_usr_rol' => $model['idusr_rol']]);
              },
              'delete' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['usuario_eliminar', 'id' => $model['idusuario']], [
                  'data' => [
                    'confirm' => 'Esta seguro de que quiere eliminar este usuario?',
                  ],]);
              }
            ]
          ],
        ],
      ]); ?>
    </div>

</div>
