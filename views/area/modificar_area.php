<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Area */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-form">
    <div class="well">
        <h3 class="text-center">ACTUALIZAR INFORMACION</h3>
        <br><br>
      <?php
      $form = ActiveForm::begin(
        [
          "method" => "post",
          "id" => "area_insertar",
          "enableAjaxValidation" => true,
        ]
      );
      ?>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'nombre_area')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'descripcion_area')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'area_idarea')->textInput(['maxlength' => true]) ?>
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
