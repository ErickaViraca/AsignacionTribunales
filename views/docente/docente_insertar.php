<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Docente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docente-form">
    <div class="well">
        <h3><?= $mensaje ?></h3>
        <h3 class="text-center">REGISTRO DE DOCENTE</h3>
        <br><br>
      <?php
      $form = ActiveForm::begin(
        [
          'id' => 'form_id',
          "method" => "post",
          "enableAjaxValidation" => true,
        ]
      );
      ?>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'nombre_doc')->textInput(['maxlength' => true, 'id' => 'nombre']) ?>
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
                <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                  <?= Html::submitButton($model->isNewRecord ? 'Registrar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>

      <?php ActiveForm::end(); ?>
    </div>
</div>