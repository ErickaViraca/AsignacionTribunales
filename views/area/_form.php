<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Area */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'nombre_area')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'descripcion_area')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'area_idarea')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

  <?php ActiveForm::end(); ?>

</div>
