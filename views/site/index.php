<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="row">
    <div class="well">
        <p class=" text-center text-info"><strong>BIENVENIDO</strong></p>
        <tr class="text-lefth info">
            <td>
                <p class="text-justify">El sistema de asignacion de tribunales, proporciona las funciones
                    necesarias que se realizan desde secretaria y concejo de carrera, para realizar la
                    asignacion de tribunales a los proyectos de la carrera de Ingenieria de Sistemas
                    e Informatica que cada semestre se presentan.
                </p>
            </td>
        </tr>
    </div>

    <div class="well">
        <h3 class="text-center text-info">PROYECTOS REGISTRADOS</h3>
        <div class="well">
            <div class="formulario-search">
                <br>
              <?php
              $form = ActiveForm::begin([
                //'layout' => 'horizontal',
                'action' => ['index'],
                'method' => 'post',
              ]);
              ?>
              <?= $form->field($model, 'palabraBuscar')->textArea(['maxlength' => true]) ?>
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
            <p class=" text-center text-info"><strong>RESULTADO</strong></p>
            <table class="table table-striped">

              <?php foreach ($titulo_proyectos as $nombre_tit) { ?>
                  <tr>
                      <td><strong class="text-info">TITULO: </strong><?php echo $nombre_tit['titulo_proy'] ?></td>
                  </tr>
                  <tr class="text-lefth info">
                      <td>
                        <?php
                        $lista_estudiante = $model->busqueda_estu_proy($nombre_tit['idproyecto']);
                        foreach ($lista_estudiante as $estudiantes) {
                          ?>
                            <p><strong> NOMBRE: </strong>
                              <?php echo Html::a($estudiantes['nombre_estu'] . ' ' . $estudiantes['paterno_estu'] . ' ' . $estudiantes['materno_estu'], ['info_estu', 'id_estudiante' => $estudiantes['idestudiante']]) . '<br>';
                              ?>
                            </p>
                        <?php } ?>
                      </td>
                  </tr>
              <?php } ?>
            </table>
        </div>
    </div>
</div>
    


