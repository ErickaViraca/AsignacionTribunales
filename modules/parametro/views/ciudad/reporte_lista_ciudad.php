<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * tarea
 * distintos formatos cuantos formatos soporta 
 * tamaño de hoja que soporta en yii2
 * imprime en tamaño A6 formato en excel word pdf point
 */

use yii\helpers\Html;

$this->title = 'Reporte Ciudad';
?>
<!--<div class="text-center rpt-margin">
<h3 class="text-uppercase"><?= $this->title ?></h3>
<?= Html::a('Salir', ['get_ciudad'], ['class' => 'btn btn-primary']) ?>
<object data="<?php //echo $url ?>" type="application/pdf" name="lista ciudad" height="700px" width="100%;">
<object type="application/msword" data="<?php echo $url ?>" width="300" height="200">
  alt : <a href="<?php echo $url ?>">test.doc</a>
</object>
<div>
No se puede abrir el Reporte, haga click en el enlace para descargar <a href="<?= $url ?>">Descargar</a>
</div>
</object>
</div>-->

<?php if ($formato== 'pdf'){?>
<?php $this->title = 'Reporte Ciudad';
?>
<div class="text-center rpt-margin">
<h3 class="text-uppercase"><?= $this->title ?></h3>
<?= Html::a('Salir', ['get_ciudad'], ['class' => 'btn btn-primary']) ?>
<object data="<?php echo $url ?>" type="application/pdf" name="lista ciudad" height="700px" width="100%;">

    <div>
No se puede abrir el Reporte, haga click en el enlace para descargar <a href="<?= $url ?>">Descargar</a>
</div>
</object>
<!--<iframe scrolling="auto" src="<?$url ?>" frameborder="0" height="300" width="300"></iframe>-->

<!--<iframe style="" src="https://docs.google.com/viewer?url=<?php // $url?>&amp;embedded=true" width="600" height="780"></iframe>-->

</div>

<?php }else if ($formato == 'word') {?>
<iframe style="" src="http://docs.google.com/viewer?url=<?php echo $url?>&amp;embedded=true" width="600" height="780"></iframe>

<div>
No se puede abrir el Reporte, haga click en el enlace para descargar <a href="<?= $url ?>">Descargar</a>
</div>
<?php }else if ($formato == 'point'){?>
<div>
No se puede abrir el Reporte, haga click en el enlace para descargar <a href="<?= $url ?>">Descargar</a>
</div>
<?php }else{ ?>
<div>
No se puede abrir el Reporte, haga click en el enlace para descargar <a href="<?= $url ?>">Descargar</a>
</div>
<?php } ?>


