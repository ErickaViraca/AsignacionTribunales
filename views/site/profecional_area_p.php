<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use app\models\AsignacionRegistroForm;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="well">
    <div class="well">
        <h4 class="text-center">AREAS DE PERTINENCIA</h4>
        <br>
        <div class="well">
           <div class="formulario-search">
                <br>
                <?php
                $form = ActiveForm::begin([
                    //'layout' => 'horizontal',
                    'action' => ['profecional_area_p'],
                    'method' => 'get',
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
       <div class="well">
         <?= GridView::widget([
        'dataProvider' => $dataProvider,
         
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombre_area',

        ],
    ]); ?>
    </div>
    </div>
</div>
