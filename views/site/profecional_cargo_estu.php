<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="well">
    <div class="well">
        <h4 class="text-center">PROFESIONAL</h4>
        <br>
        <div class="formulario-search">
                    <br>
                    <?php
                    $form = ActiveForm::begin([
                        //'layout' => 'horizontal',
                        'action' => ['profecional_cargo_estu'],
                        'method' => 'post',
                    ]);
                    ?>
                    <?= $form->field($model, 'palabraBuscar') ?>
                    <div class="form-group text-center">

                        <?=
                        Html::submitButton('BUSCAR', [
                        'class' => 'btn btn',
                        'style' => 'width:200px; background-color: #959292;',])
                    ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
     <h4 class="text-center">CANTIDAD DE PROYECTOS ASIGNADOS A UN PROFESIONAL</h4>
          <div class="well">
         <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'idusuario',
            'nombre_doc',
            'cant_estu_tri',
             
            // 'accessToken',
            
            
        ],
    ]); ?>
    </div>
    </div>
</div>

