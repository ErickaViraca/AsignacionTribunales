<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Docente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docente-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'nombre_doc')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'paterno_doc')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'materno_doc')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'correo_doc')->textInput() ?>

  <?= $form->field($model, 'titulo_doc')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'carga_horaria_doc')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'nombre_cuenta_doc')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'telefono_doc')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'direccion_tra_doc')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'perfil_doc')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'ci_doc')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'cod_sis_doc')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'es_tutor')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'es_tribunal')->textInput() ?>

  <?= $form->field($model, 'cant_estu_tri')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

  <?php ActiveForm::end(); ?>

</div>
