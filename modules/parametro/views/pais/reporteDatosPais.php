<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * tarea
 * distintos formatos cuantos formatos soporta 
 */

use yii\helpers\Html;

$this->title = 'Reporte Pais';
?>
<div class="text-center rpt-margin">
<h3 class="text-uppercase"><?= $this->title ?></h3>
<?= Html::a('Salir', ['get_pais'], ['class' => 'btn btn-primary']) ?>
<object data="<?= $url ?>" type="application/pdf" name="datos de pais" height="700px" width="100%;">
<div>
No se puede abrir el Reporte, haga click en el enlace para descargar <a href="<?= $url ?>">Descargar</a>
</div>
</object>
</div>



