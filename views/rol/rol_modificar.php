<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\menu;

/* @var $this yii\web\View */
/* @var $model app\modules\rol\models\Rol */
/* @var $form yii\widgets\ActiveForm */
//print_r($model_menu);
//die();
?>

<div class="rol-form">
    <div class="well">
         <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2"></div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <h3 class="text-center">ACTUALIZAR DE ROL</h3>
                 <br>
                <?php $form = ActiveForm::begin(
                        [ 'options' => ['class' => 'form-horizontal'],
                          'enableClientValidation' => true,
                        ]
                       
                        ); ?>

                <?= $form->field($model, 'nombre_rol')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'id_menu')->checkboxList($model_menu) ?>
                 <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6"></div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                         <?= Html::submitButton($model->isNewRecord ?  : 'Guardar Cambios', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                         </div> 
                    </div>
                 </div>
                <?php ActiveForm::end(); ?> 
            </div> 
            <div class="col-lg-2 col-md-2 col-sm-2"></div>   
         </div>
    </div>

   

</div>
