<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="well">
    <h4 class="text-center">REGISTRO DE TRIBUNALES ASIGNADOS</h4>
    <div class="well">
        <!--rescatando el titulo-->
        <div>
            TITULO
         <?php foreach ($model_titulo as $datos_titulo){ ?>
        <div>  <?php echo $datos_titulo['titulo_proy']  ?></div>
        <?php } ?>   
        </div>
        <!--rescatando estudiantes-->
        <div>
            NOMBRE
         <?php foreach ($model_estu as $datos_estu){ ?>
        <div> - <?php echo $datos_estu['nombre_estu'].' '. $datos_estu['paterno_estu'].' '.$datos_estu['materno_estu']; ?></div>
        <?php } ?>   
        </div>
        <div>
            TRIBUNALES
        <?php foreach ($model_prof as $datos_prof){ ?>
        <div> - <?php echo $datos_prof['nombre_doc']  ?></div>
        <?php } ?>
        </div>
        <?php ?>
        <?php ?>
    </div>
</div>
