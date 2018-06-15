<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idusuario') ?>

    <?= $form->field($model, 'nombre_usr') ?>

    <?= $form->field($model, 'apellido_paterno_usr') ?>

    <?= $form->field($model, 'apellido_materno_usr') ?>

    <?= $form->field($model, 'celular_usr') ?>

    <?php // echo $form->field($model, 'correo_usr') ?>

    <?php // echo $form->field($model, 'usuario') ?>

    <?php // echo $form->field($model, 'contrasenia') ?>

    <?php // echo $form->field($model, 'conf_contrasenia') ?>

    <?php // echo $form->field($model, 'activate') ?>

    <?php // echo $form->field($model, 'accessToken') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
