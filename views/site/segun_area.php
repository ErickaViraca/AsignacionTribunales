<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\TribunalForm;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">
    <div class="well">
        <h4 class="text-center text-info">LISTA DE PROFESIONALES SEGUN EL AREA DEL TITULO </h4>
        <br>
        <div class="well">
            <?php
            $form = ActiveForm::begin([
                       // 'layout' => 'horizontal',
                        'action' => ['segun_area'],
                        'method' => 'post',
            ]);
            ?>
            
                <?php
                $listo_asignar = tribunalForm::lista_titulo_aprobados();
                $listData = ArrayHelper::map($listo_asignar, 'idproyecto', 'titulo_proy');
                echo $form->field($model, 'lista_titulo')->dropDownList(
                        $listData, ['prompt' => 'SELECCIONAR EL TITULO DE PROYECTO', 'id'=>'cambiar_titulo']);
                ?>   
           
            <div class="form-group text-center">
                    <?=
                    Html::submitButton('BUSCAR', [
                        'class' => 'btn btn',
                        'style' => 'width:250px; background-color: #959292;',

                    ])
                    ?>
            </div>
            <?php ActiveForm::end(); ?>
            <hr>
             <strong>ESTUDIANTE</strong>
            <table class="table table-condensed">
                <tr class="info">
                     <?php
                     $contador = 1;
                     foreach ($lista_estudiante as $dato_estudiante){ ?>
                    <td>
                      <?php echo $contador++.'.- '. $dato_estudiante['nombre_estu']; ?>   
                    </td>
                    <?php } ?>  
                </tr>
            </table>                
            <strong>AREA DEL PROYECTO</strong>
            <table class="table table-condensed">
                 <tr>
                     <td>NOMBRE TUTOR</td>
                     <td>AREA</td>
                 </tr> 
                  <?php foreach($lista_tutor as $datos_tutor){ ?>
                 <tr class="info">
                    <td> <?php echo $datos_tutor['nombre_doc'].' '.$datos_tutor['paterno_doc'].' '.$datos_tutor['materno_doc'];?></td>
                    <td>
                    <?php  $areas = $model->lista_area($datos_tutor['iddocente']);
                            foreach ($areas as $dato_area){ ?>
                     <?php  echo $dato_area['nombre_area'].'<br>'; ?>      
                    <?php  } ?>
                        </td>
                 </tr>
                 <?php } ?>
             </table>
             </div>       
            <div class="form-group text-right">
                   <?php if(!empty($bandera)){?>
                        <?php echo Html::a('lista para asignar profesionales',['lista_profesionales', 'id_titulo'=>$bandera],['class' => 'btn btn-primary', 'style' => 'background-color: #959292;']).'<br>';
                      ?>
                   <?php }else{} ?>               
            </div>
        
    </div>
</div>


