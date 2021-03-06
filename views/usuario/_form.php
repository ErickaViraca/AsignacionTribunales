<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_usr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido_paterno_usr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido_materno_usr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'celular_usr')->textInput() ?>

    <?= $form->field($model, 'correo_usr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contrasenia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conf_contrasenia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activate')->textInput() ?>

    <?= $form->field($model, 'accessToken')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
