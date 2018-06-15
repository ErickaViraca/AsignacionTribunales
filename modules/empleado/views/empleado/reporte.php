<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * tarea
 * distintos formatos cuantos formatos soporta 
 */

use yii\helpers\Html;

$this->title = 'Reporte Subsidio';
?>
<div class="text-center rpt-margin">
<h3 class="text-uppercase"><?= $this->title ?></h3>
<?= Html::a('Salir', ['empleado_get'], ['class' => 'btn btn-primary']) ?>
<object data="<?= $url ?>" type="application/pdf" name="Subsidio Empleado" height="700px" width="100%;">
<div>
No se puede abrir el Reporte, haga click en el enlace para descargar <a href="<?= $url ?>">Descargar</a>
</div>
</object>
</div>
