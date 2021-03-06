<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Area */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-form">
    <div class="well">
        <h3><?= $mensaje ?></h3>
        <h3 class="text-center">REGISTRO DE AREA</h3>
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
                <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                  <?= Html::submitButton($model->isNewRecord ? 'Registrar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>

      <?php ActiveForm::end(); ?>
    </div>
</div>