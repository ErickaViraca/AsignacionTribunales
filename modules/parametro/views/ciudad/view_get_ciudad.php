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
                                    'action' => ['param_ciudad_get'],
                                    'method' => 'get',
                        ]);
                        ?>
                            <?= $form->field($model, 'palabraBuscar') ?>
                        <div class="form-group text-center">

                            <?=
                            Html::submitButton('BUSCAR', [
                                'class' => 'btn btn-primary',
                                'style' => 'width:250px;',
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
            <div class="boton-crear-pais text-center">
                <p>
                    <?php
                echo Html::a('AÑADIR CIUDAD', '#', [
                    'id' => 'activity-index-link',
                    'style' => 'width:200px;',
                    'class' => 'btn btn-primary',
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'data-url' => Url::to(['ciudad_insert']),
                    'data-pjax' => '0',
                ]);
                ?> 
                </p>
                <p>
                    <?php echo Html::a('IR A PAIS', ['/parametro/pais/param_pais_get'], ['class' => 'btn btn-primary', 'style' => 'width:200px;']) ?>      
                </p>
                <p>
                    <?php  echo Html::a('IR EMPLEADO', ['/empleado/empleado/empleado_get'], ['class' => 'btn btn-primary', 'style' => 'width:200px;']) ?>      
                </p>
                   
            </div>
            <div class="crear-empleado">

                <?php
                $this->registerJs(
                        "$(document).on('click', '#activity-index-link', (function() {
                $.get($(this).data('url'),function (data) {
                $('.modal-body').html(data);
                $('#modal').modal();});
                }));"
                );
                ?>
                <?php
                Modal::begin([
                    'id' => 'modal',
                    'header' => '<h4 class="modal-title text-center well">REGISTRAR CIUDAD</h4>',
                ]);
                ?>
                <?php
                Modal::end();
                ?>
            </div>                           
        </div> 
    </div>
    <div class="col-lg-3 col-md-3 col-xs-3">       
        <div class="well">
            <div class="thumbnail">
                <img src="/basic/web/images/lp3.jpg" width="170" height="170">
            </div>
            <!--<p class="text-center">EL MUNDO</p>-->
        </div> 
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
              
                <p>
                      REPORTES :&nbsp;&nbsp;&nbsp;&nbsp;      
                 <?php echo Html::a('<img alt="imagen html de ejemplo" src="/basic/web/images/ico/pdf.png" width="30" height="30" />', ['reporte_lista_ciudad'], ['class' => '', 'style' => 'width:200px;']) ?>      
                 &nbsp;&nbsp;<?php echo Html::a('<img alt="imagen html de ejemplo" src="/basic/web/images/ico/word.ico" width="20" height="20" />', ['reporte_listas_ciudad'], ['class' => '', 'style' => 'width:200px;']) ?>      
                 &nbsp;&nbsp;<?php echo Html::a('<img alt="imagen html de ejemplo" src="/basic/web/images/ico/excel.png" width="20" height="20" />', ['reporte_listas_ciudades'], ['class' => '', 'style' => 'width:200px;']) ?>      
                 &nbsp;     <?php echo Html::a('<img alt="imagen html de ejemplo" src="/basic/web/images/ico/point.png" width="20" height="20" />', ['reportes_listas_ciudades'], ['class' => '', 'style' => 'width:200px;']) ?>      
           
                </p>  
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="well">
            <div class="thumbnail">
                <div class="get-pais">
                    <h5 class="text-center"><strong>LISTA DE CIUDAD REGISTRADO</strong></h5>
                    <?php Pjax::begin() ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'id_paises',
                            'codigos',
                            'nombres',
//                            'activos:boolean',
                            'nombre_pais',  
//                            'id_pais',
//                            ['class' => 'yii\grid\ActionColumn'],
                            ['class' => 'yii\grid\ActionColumn',
                                        'header' => 'ESTADO',
                                        'template' => '{estado}',
                                        'buttons' => [
                                            'estado'=>  function ($url, $model){
                                                if($model['activos']==true){
                                                    return Html::a('Activado',$url, ['title'=>'desactivar']);
                                                }else{
                                                    return Html::a('Desactivado', $url, ['title'=>'Activar']);
                                                }
                                            }
                                            
                                                ],
                                            'urlCreator'=>function($action, $model){
                                                  if($action=='estado')
                                                   { return Url::to(['estado_ciudad', 'id'=>$model['id_ciudades']]);}  
                                            }
                                            ],
                            ['class' => 'yii\grid\ActionColumn',
                                        'header' => 'REPORTE',
                                        'template' => '{pdf} {word}{excel}',
                                        'buttons' => [                                           
                                               'pdf' => function ($url, $model) {
                                                return Html::a('<span class=""><img alt="imagen html de ejemplo" src="/basic/web/images/ico/pdf.png" width="30" height="30" /></span>', ['datos_ciudad', 'id_ciudad' => $model['id_ciudades']], [
                                                            
                                                ]);
                                            },
                                            'word' => function ($url, $model) {
                                                return Html::a('<span class=""><img alt="imagen html de ejemplo" src="/basic/web/images/ico/word.ico" width="20" height="20" /></span>', ['dato_ciudad', 'id_ciudad' => $model['id_ciudades']], [
                                                            
                                                ]);
                                            }]],
                            
                            
                            ['class' => 'yii\grid\ActionColumn',
                                'header' => 'OPCION',
                                'template' => '{update} {delete}',
                                'buttons' => [
//                    'view' => function($url, $model) {
//                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['', 'id' => $model['id_empleados']]);
//                    },
                                    'update' => function($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [ 'id' => 'activity-index-link',
                                                    'class' => 'text-primary',
                                                    'title' => 'modificar',
                                                    'data-toggle' => 'modal',
                                                    'data-target' => '#modal',
                                                    'data-url' => Url::to(['param_ciudad_update', 'id' => $model['id_ciudades']]),
                                                    'data-pjax' => '0',
                                        ]);
                                    },
                                            'delete' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['param_ciudad_delete', 'id' => $model['id_ciudades']], [
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
                      <?php Pjax::end() ?> 
                </div>
            </div>
        </div>
    </div> 
</div>

