<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Docente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docente-form">
    <div class="well">
        <h3 class="text-center">ACTUALIZAR INFORMACION</h3>
        <br><br>
      <?php
      $form = ActiveForm::begin(
        [
          "method" => "post",
          "id" => "docente_insertar",
          "enableAjaxValidation" => true,
        ]
      );
      ?>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'nombre_doc')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'paterno_doc')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'materno_doc')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'correo_doc')->textInput() ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'titulo_doc')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'carga_horaria_doc')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'telefono_doc')->textInput() ?>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
              <?= $form->field($model, 'direccion_tra_doc')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'perfil_doc')->textInput() ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'ci_doc')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'cod_sis_doc')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                  <?= Html::submitButton($model->isNewRecord ?: 'Guardar Cambios', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
      <?php ActiveForm::end(); ?>
    </div>
</div>
