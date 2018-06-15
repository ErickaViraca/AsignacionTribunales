<?php

//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\helpers\Url;
//use yii\bootstrap\Modal; //importando modal
//use kartik\widgets\DepDrop;
//use yii\helpers\Html;
//use app\modules\parametro\models\Pais;
//use yii\helpers\ArrayHelper;


use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\parametro\models\Pais;
use yii\helpers\Url;
use app\modules\parametro\models\Ciudad;
use yii\widgets\Pjax;
use yii\bootstrap\Modal; //importando modal
use kartik\file\FileInput;
use kartik\widgets\DepDrop;
use yii\helpers\Html;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\empleado\models\Empleado */
/* @var $form yii\widgets\ActiveForm */
//echo"<pre>";
//print_r($model);
//echo "</pre>";
//die();
?>

<div class="empleado-form">

    <div class="well">
        <h4>FORMULARIO EMPLEADO</h4>
        <?php Pjax::begin(['id' => 'nuevo-pais']) ?>
        <?php $form = ActiveForm::begin([
                'options'=>['enctype'=>'multipart/form-data'], // important
                ]); ?>
        <div class="row">
            <div class="col-lg-7">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                <?=
                $form->field($model, 'nombre', [
                    'template' => "{label}\n<div class=\"col-lg-8 col-md-8 col-sm-7\">{input}</div>\n<div class=\"col-lg-12 text-right\">{error}</div>\n",
                    'labelOptions' => ['class' => 'col-lg-4 col-md-4 col-sm-5 text-right']
                ])->widget(DatePicker::className(), [
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'dd/mm/yyyy',
                        'startDate' => $model->nombre
                       // 'startDate' => ($model->emp_getVacacionAnterior() > 0) ? '': ($model->emp_getDiaActual()==1?'-3d':'-1d')
                    ]
                ])
                ?>

                <?= $form->field($model, 'apellido_p')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'apellido_m')->textInput(['maxlength' => true]) ?>
               
                <?= $form->field($model, 'cedula_identidad')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
            
                <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?> 
           
            </div>
            <div class="col-lg-5">
                <div class="well">
                    <!--campo para subir imagen una ves cargado-->
                    <div class="thumbnail">
                        <div class="well">
                          <!--<img src="/basic/web/images/usr.jpg"   width="100%"  height="200px"   style="background-size: cover;"/>-->    
                        <?php 
                         $src="/basic/web/images/usr.jpg";
                         if($model->imagen){           
                           echo '<img src="data:image/png;base64,'.$ima.'" id= "imgSalida"  width="100%"  height="200px"   style="background-size: cover;"/>';
                         }else{
                        ?>
                        <?php echo Html::img($src,$options = [ 'id' => 'imgSalida', 'height'=>'200px', 'width'=>'100%'])?> 
                       <?php } ?>
                        </div>  
                          <?php 
                          // echo '<img src="data:image/png;base64,'.$ima.'"/>';
                          ?>                        
                    </div>                   
                    <?php echo $form->field($model, 'imagen')->fileInput([
                          'id'=>'files',
                          'class'=>'btn btn-info']) ?>                        
                     <script>
                //funcion para previsualizar la imagen
                function handleFileSelect(evt) {
                    var files = evt.target.files[0]; // FileList object
                    if (!files.type.match('image.*')) {
                        return;
                    }
                    var reader = new FileReader();
                    reader.onload = (function(theFile) {
                        return function(e) {
                        var result=e.target.result;
                        $("#imgSalida").attr("src",result);
                      };
                    })(files);
                    reader.readAsDataURL(files);
                }
                //Lanzador de evento para llamar la funcion handleFileSelect
                document.getElementById('files').addEventListener('change', handleFileSelect, false);
                </script>
                 
                </div>

            </div>   
        </div>
        <div class="row">           
            <div class="col-lg-12">
                </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div id="pais-nombre">
                    <?php
                    $paises = Pais::param_get_status_pais(true);
//                    print_r($paises);
//                    die();
                    $listData = ArrayHelper::map($paises, 'id_pais', 'nombre');
                    
                    echo $form->field($model, 'pais')->dropDownList(
                            $listData, ['id' => 'pais_id', 'prompt' => 'SELECCION...']);
                    
                   
                    ?> 
                </div>

                <p>
                    <?=
                    Html::a('+', '#', [
                        'id' => 'activity-index-link',
                        'class' => 'btn btn-info ',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'data-url' => Url::to(['/parametro/pais/add_form_emp_pais']),
                        'data-pjax' => '0',
                    ]);
                    ?>  
                </p>
            </div>
            <div class="col-lg-6">
                <?php
                echo $form->field($model, 'id_ciudad')->widget(DepDrop::classname(), [
                    'data' => ArrayHelper::map(Ciudad::param_get_ciudades_pais($model->pais), 'id', 'name'),
                    'options' => ['id' => 'ciudad_id'],
                    'pluginOptions' => [
                        'depends' => ['pais_id'],
                        'placeholder' => 'SELECCIONE...',
                        'url' => Url::to(['sub_ciudad'])
                    ]
                ])  ;
                ?>
                <p>
                <?=
                Html::a('+', '#', [
                    'id' => 'activity-index-link',
                    'class' => 'btn btn-info ',
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'data-url' => Url::to(['/parametro/ciudad/ciudad_insert_emp']),
                    'data-pjax' => '0',
                ]);
                ?>  
                </p>

            </div> 
        </div>

        <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
            <?php ActiveForm::end(); ?>
        <?php Pjax::end() ?>
    </div>
</div>
<div class="crear-pais">
   
</div>
 <!--evento para el boton en este caso el click-->
    <?php
    Modal::begin([
        'id' => 'modal',
        'header' => '<h4 class="modal-title text-center well">REGISTRO DATOS</h4>',
    ]);
    Modal::end();
    ?>