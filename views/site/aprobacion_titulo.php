<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="row">
    <div class="well">
        <h4 class="text-center text-info">BUSCAR TITULO DE PROYECTO</h4>
        <p class="text-justify">Introduzca el titulo del proyecto para 
        la busqueda correspondiente y elegir la opcion 
        de listo para asignar tribunal
        </p>
        <div class="well">
            <div class="formulario-search">
                <?php
                $form = ActiveForm::begin([
                            //'layout' => 'horizontal',
                            'action' => ['aprobacion_titulo'],
                            'method' => 'post',
                ]);
                ?>
                <?= $form->field($model,'palabraBuscar')->textArea(['maxlength' => true]) ?>
                <div class="form-group text-right">
                    <?=
                    Html::submitButton('BUSCAR', [
                        'class' => 'btn btn',
                        'style' => 'width:200px; background-color: #959292;',])
                    ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="well">
            <p class=" text-center text-info"><strong>RESULTADO DE TITULOS</strong></p>
            <table class="table table-striped">            
                 <?php foreach($titulo_aprobado as $lista_titulo){?>
                <tr>
                    <td><strong class="text-info">TITULO: </strong><?php echo $lista_titulo['titulo_proy']?></td>
                </tr>
                <tr>
                    <td>   
                      <?php 
                      $lista_estudiante = $model->nombre_estudiante($lista_titulo['idproyecto']);
                         foreach($lista_estudiante as $estudiantes){
                        ?> 
                        <p> <strong> NOMBRE: </strong>
                        <?php echo $estudiantes['nombre_estu'].' '.$estudiantes['paterno_estu'].' '.$estudiantes['materno_estu'].'<br>';
                      ?>
                        </p>
                    <?php }?>
                    </td> 
                </tr>
                <tr class="text-right info">                 
                    <?php if($lista_titulo['asig_tribunal_listo']==1){?>
                    <?php  ?>
                    <td><?php echo Html::a('Cancelar la asignacion',['enviar_tribunales', 'id'=>$lista_titulo['idproyecto'], 'opcion'=>$lista_titulo['asig_tribunal_listo']],['title'=>'Asignar a tribunal'])?></td>
                    <?php }else{ ?>
                     <td><?php echo Html::a('Asignar a tribunal',['enviar_tribunales', 'id'=>$lista_titulo['idproyecto'], 'opcion'=>$lista_titulo['asig_tribunal_listo']],['title'=>'Cancelar la asignacion'])?></td>
                    <?php }?>
                </tr>
                <?php }?>
            </table>
        </div>
    </div>
</div>