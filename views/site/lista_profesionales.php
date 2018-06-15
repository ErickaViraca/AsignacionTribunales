<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;

//echo $id_titulo;
?>
<div class="row">
    <div class="well">
        <div class="well">
            <h4 class="text-center text-info">LISTA PARA ASIGNAR A TRIBUNALES </h4>
             <?php $form = ActiveForm::begin([
                    //'action' => ['lista_profesionales'],
                    //'id_titulo'=>$id_titulo,
                    'method' => 'post',
                    "enableAjaxValidation" => true,
                ]); ?>
                  <?=
                $form->field($model, 'fecha_registro', [
                    'template' => "{label}\n<div class=\"col-lg-8 col-md-8 col-sm-7\">{input}</div>\n<div class=\"col-lg-12 text-right\">{error}</div>\n",
                    'labelOptions' => ['class' => 'col-lg-4 col-md-4 col-sm-5 text-right']
                ])->widget(DatePicker::className(), [
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        //'format' => 'dd/mm/yyyy',
                        'format' => 'yyyy/mm/dd',
                        'startDate' => $model->fecha_registro
                       // 'startDate' => ($model->emp_getVacacionAnterior() > 0) ? '': ($model->emp_getDiaActual()==1?'-3d':'-1d')
                    ]
                ])
                ?>
             
             <h5 class="text-center text-info"> <strong>LISTA DE PROFESIONALES SEGUN EL AREA</strong> </h5>
             <table class="table table-striped">
                 <tr>
                     <td class="text-info"> <strong>PROFESIONAL</strong></td>
                     <td class="text-info"><strong>AREA</strong></td>
                 </tr>
                
                 <?php 
                  $obtener_lista_titulo= $model->obtener_lista_titulo($id_titulo);
                  foreach($obtener_lista_titulo as $id_area){
                      $id_nombre = $model->lista_docentes_asignar($id_area['idarea']);
                        foreach($id_nombre as $nombre_docente){
                  ?>
                    <tr>
                        <td>
                            <input id="selecionar" type="checkbox" name=mischecks[] value="<?php echo $nombre_docente['iddocente'] ?>"> <?php echo $nombre_docente['nombre_doc'].' '.$nombre_docente['paterno_doc'] .' '.$nombre_docente['materno_doc']?>
                        </td>
                        <td>
                            <?php echo $nombre_docente['nombre_area']; ?>
                        </td>
                    </tr>
                  <?php } ?>
                  <?php } ?>
                  
                 <?php ?>
                 <?php ?>
             </table>
             
             <br>
             <div class="form-group">
          <?=
                    Html::submitButton('ASIGNAR', [ 
                        'class' => 'btn btn',
                        'style' => 'width:250px; background-color: #959292;',
                        'id'=>"submit", 
                    ])
                    ?>
        </div>

    <?php ActiveForm::end(); ?> 
    </div>    
</div>
