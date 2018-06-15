<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Rol;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">
    <div class="well">
        <h3><?= $mensaje ?></h3>
        <h3 class="text-center">REGISTRO DE USUARIO</h3>
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
              <?= $form->field($model, 'nombre_usr')->textInput(['maxlength' => true, 'id' => 'nombre', 'options' => []]) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'apellido_paterno_usr')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'apellido_materno_usr')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
              <?= $form->field($model, 'celular_usr')->textInput() ?>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-8">
              <?= $form->field($model, 'correo_usr')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5">
              <?= $form->field($model, 'usuario')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7"></div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5">
              <?= $form->field($model, 'contrasenia')->passwordInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5">
              <?= $form->field($model, 'conf_contrasenia')->passwordInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
          <?php
          $roles = Rol::find()->All();
          $listaRoles = ArrayHelper::map($roles, 'idrol', 'nombre_rol');
          ?>
            <div class="col-lg-5 col-md-5 col-sm-5">
              <?= $form->field($model, "id_rol")->dropDownList($listaRoles, ['prompt' => 'Seleccionar el rol']) ?>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7"></div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                  <?= Html::submitButton($model->isNewRecord ? 'Registrar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
                </div>
            </div>
        </div>
      <?php ActiveForm::end(); ?>
    </div>
</div>

