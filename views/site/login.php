<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'INICIAR SESION';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="well">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2"></div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

    <p>Por favor complete los siguientes campos para iniciar sesión:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
       // 'layout' => 'horizontal',
//        'fieldConfig' => [
//            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-1 control-label'],
//        ],
    ]); ?>
     <div class="row">
         <div class="col-lg-6 col-md-6 col-sm-6">
             <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            
        ]) ?>   
         </div>  
         <div class="col-lg-3 col-md-3 col-sm-3s">
          
         </div> 
         <div class="col-lg-3 col-md-3 col-sm-3">
             
         </div> 
     </div> 
     <?php //$form->field($model, 'rememberMe')->checkbox([
           // 'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        //]) ?>

        <div class="form-group">
            <div class="col-lg-11 text-center">
                <?= Html::submitButton('Iniciar sesion', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

            </div>
            <div class="col-lg-2 col-md-2 col-sm-2"></div>
        </div>
    </div>
    
</div>
