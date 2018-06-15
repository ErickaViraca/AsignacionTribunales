<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax; 


/* @var $this yii\web\View */
/* @var $model app\modules\parametro\models\Pais */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pais form">
    <div class="well">
        
   
<?php $form = ActiveForm::begin(
            [
                'layout' => 'horizontal',
                'id' => 'solicitante-form',
                'enableAjaxValidation' => true,
                'enableClientScript' => true,
                'enableClientValidation' => true,
            ]
            );
    
    ?>
   

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'id'=>'pais-nom']) ?>

    <?php if($bandera== 'pais_insert' || $bandera== 'add_form_emp_pais' ){ ?>
    <?php $model->activo = true;?>
        <?= $form->field($model, 'activo')->checkbox(); ?>
    <?php }else {?>
         <?= $form->field($model, 'activo')->checkbox(); ?>
    <?php }?>    
    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-info' : 'btn btn-primary', 'style' => 'width:200px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>
   

 </div>
</div>
<?php
$this->registerJs(
    '
      $("form#solicitante-form").on("beforeSubmit", function(e) {
            var form = $(this);
            $.post(
                form.attr("action")+"&submit=true",
                form.serialize()
            )
            .done(function(result) {
                form.parent().html(result.message);
                //var nombre="bolivia";
                //alert($("#pais-nom").val());
                $.post("index.php?r=parametro/pais/param_pais_get_nombre&nombre='.'"+$("#pais-nom").val(), function(data){
                        var pais=jQuery.parseJSON(data);
                         //alert($("#pais-nombre").val());
                         //console.log(data);
                        $("#pais_id").append(new Option(pais.nombres, pais.id_paises, true, true));
                        $("#modal").modal("hide");
                        
                    });

            });
             
    
            return false;
        })
       
    '
        
        );
?>