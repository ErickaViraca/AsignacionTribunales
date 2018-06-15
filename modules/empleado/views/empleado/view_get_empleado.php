<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url; // importando redirecionando url    
use yii\widgets\Pjax;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">
    <div class="col-lg-6 col-md-6 col-xs-6">
        <div class="row">
            <div class="well">
                <div class="thumbnail">
                    <div class="formulario-search">
                        <br>
                        <?php
                        $form = ActiveForm::begin([
                                    'layout' => 'horizontal',
                                    'action' => ['empleado_get'],
                                    'method' => 'get',
                        ]);
                        ?>
                        <?= $form->field($model, 'palabraBuscar') ?>
                        <div class="form-group text-center">

                            <?=
                            Html::submitButton('BUSCAR', [
                                'class' => 'btn btn',
                                'style' => 'width:250px; background-color: #959292;',
                               
                            ])
                            ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-xs-3">       
        <div class="well">
            <p class="text-center"><strong>OPCION</strong></p>
            <p class="text-center">
                <?= Html::a('AÑADIR EMPLEADO', ['empleado_insert'], ['class' => 'btn btn-primary', 'style' => 'width:200px;  background-color: #959292;']) ?>
            </p>
            <p class="text-center">
                <?php echo Html::a('IR PAIS', ['/parametro/pais/param_pais_get'], ['class' => 'btn btn-primary', 'style' => 'width:200px;  background-color: #959292;']) ?>
            </p>
            <p class="text-center">
                <?php echo Html::a('IR CIUDADES', ['/parametro/ciudad/param_ciudad_get'], ['class' => 'btn btn-primary', 'style' => 'width:200px;  background-color: #959292;']) ?>
            </p>          
        </div> 
    </div>
    <div class="col-lg-3 col-md-3 col-xs-3">       
        <div class="well">
            <div class="thumbnail">
                <img src="/basic/web/images/empleado.jpg" width="210" height="210">
            </div>
            <!--<p class="text-center">EL MUNDO</p>-->
        </div> 
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
              
                <p>
                      REPORTES :&nbsp;&nbsp;&nbsp;&nbsp;      
                 <?php echo Html::a('<img alt="imagen html de ejemplo" src="/basic/web/images/ico/pdf.png" width="30" height="30" />', ['reporte_lista_empleado'], ['class' => '', 'style' => 'width:200px;']) ?>      
                 &nbsp;&nbsp;<?php echo Html::a('<img alt="imagen html de ejemplo" src="/basic/web/images/ico/word.ico" width="20" height="20" />', ['reporte_listas_empleado'], ['class' => '', 'style' => 'width:200px;']) ?>      
                 &nbsp;&nbsp;<?php echo Html::a('<img alt="imagen html de ejemplo" src="/basic/web/images/ico/excel.png" width="20" height="20" />', ['reporte_listas_empleados'], ['class' => '', 'style' => 'width:200px;']) ?>      
                 &nbsp;     <?php echo Html::a('<img alt="imagen html de ejemplo" src="/basic/web/images/ico/point.png" width="20" height="20" />', ['reportes_listas_empleados'], ['class' => '', 'style' => 'width:200px;']) ?>      
           
                </p>  
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="well">
            <div class="thumbnail">
                <div class="get-pais">
                    <h5 class="text-center"><strong>LISTA DE REGISTRO DE EMPLEADOS</strong></h5>
                    
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'id_paises',
                            'nombres',
                            'apellido_ps',
                            'apellido_ms',
                            'ci',
                            'telefonos',
                            'direcciones',
                            //'imagen_e',
                            'nombre_ciudad',
                            //'foto_e',
//                            ['class' => 'yii\grid\ActionColumn'],
//                            ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            //'message:ntext',
                            //'permissions',
                           // 'created_at',
                           // para mostrar la imagen
//                            [
//                                'attribute' => 'Imagen',
//                                'format' => 'raw',
////                                 <img src="/basic/web/images/empleado.jpg" width="210" height="210">
//
//                                'value' => function ($model) {
////                                    print_r($model);
////                                    die();
//                                    if ($model['foto_e'] != '')                                       
//                                        return '<img src="/basic/web/uploads/status/' . $model['foto_e']. '" width="50px" height="auto">';
//                                    else
//                                        return 'no image';
//                                },
//                            ],
                            ['class' => 'yii\grid\ActionColumn',
                                'header' => 'OPCION',
                                'template' => '{pdf} {word}',
                                'buttons' => [
//                    'view' => function($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['', 'id' => $model['id_empleados']]);
//                    },
                                    'pdf' => function($url, $model) {
                                        return Html::a('<span class=""><img alt="imagen html de ejemplo" src="/basic/web/images/ico/pdf.png" width="30" height="30" /></span>', ['empleado_dato', 'id' => $model['id_empleados']]);
                                    },
                                    'word' => function ($url, $model) {
                                        return Html::a('<span class=""><img alt="imagen html de ejemplo" src="/basic/web/images/ico/word.ico" width="20" height="20" /></span>', ['empleados_datos', 'id' => $model['id_empleados']]);
                                    }
                                        ]],
                                ['class' => 'yii\grid\ActionColumn',
                                'header' => 'OPCION',
                                'template' => '{update} {delete}',
                                'buttons' => [
//                    'view' => function($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['', 'id' => $model['id_empleados']]);
//                    },
                                    'update' => function($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['empleado_update', 'id' => $model['id_empleados']]);
                                    },
                                            'delete' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['empleado_delete', 'id' => $model['id_empleados']], [
                                                    'data' => [
                                                        'confirm' => 'Esta seguro de que quiere eliminar?',
                                                    //'method' => 'post',
                                                    ],
                                        ]);
                                    }
                                        ]],
                                ],
                            ]);
                            ?>
      
                </div>
            </div>
        </div>
    </div> 
</div>

