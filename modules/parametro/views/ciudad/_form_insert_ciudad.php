<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;


use app\modules\parametro\models\Pais;
use yii\helpers\ArrayHelper

/* @var $this yii\web\View */
/* @var $model app\modules\parametro\models\Ciudad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ciudad-form">
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

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'id_pais')->textInput() ?>
    
    <?php           
        $paises=Pais::find()->All();
        $listData=ArrayHelper::map($paises,'id_pais','nombre');     
        echo $form->field($model, 'id_pais')->dropDownList(
                                $listData,['prompt'=>'Selection...']);
    ?>
    <?php if ($bandera == 'ciudad_insert'){?>
    <?php $model->activo = true ?> 
    <?= $form->field($model, 'activo')->checkbox() ?>
    <?php }else{ ?>
        <?= $form->field($model, 'activo')->checkbox() ?>
    <?php }?>
      
    
   

    <div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-info', 'style' => 'width:250px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>
 </div>
</div>
<?php 
$this->registerJs('
    // obtener la id del formulario y establecer el manejador de eventos
        $("form#solicitante-form").on("beforeSubmit", function(e) {
            var form = $(this);
            $.post(
                form.attr("action")+"&submit=true",
                form.serialize()
            )
            .done(function(result) {
                form.parent().html(result.message);
                //alert($("#ciudad-nombre").val());
                $.post("index.php?r=parametro/ciudad/param_ciudad_get_nombre&nombre='.'"+$("#ciudad-nombre").val(), function(data){
                        var ciudad=jQuery.parseJSON(data);
                        //alert(data);
                         //alert($("#pais-nombre").val());
                         //console.log(data);
                        $("#ciudad_id").append(new Option(ciudad.nombre_c, ciudad.id_c, true, true));
                        $("#modal").modal("hide");
                 });
            });
            return false;
        }).on("submit", function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            return false;
        });
    ');
?>
