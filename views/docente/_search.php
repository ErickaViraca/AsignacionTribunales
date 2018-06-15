<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocenteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docente-search">

  <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
  ]); ?>

  <?= $form->field($model, 'iddocente') ?>
  <?= $form->field($model, 'nombre_doc') ?>
  <?= $form->field($model, 'paterno_doc') ?>
  <?= $form->field($model, 'materno_doc') ?>
  <?= $form->field($model, 'titulo_doc') ?>
  <?= $form->field($model, 'direccion_tra_doc') ?>

    <div class="form-group">
      <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
      <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

  <?php ActiveForm::end(); ?>

</div>
