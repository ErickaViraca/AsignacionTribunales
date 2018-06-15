<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\AsignacionRegistroForm;
?>
<div class="row">
<div class="well">
    
	<?php
	 ?>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <h3 class="text-success text-center">INFORMACION DEL ESTUDIANTE</h3><br> 
                <div class="well">
                <tr class="text-lefth info">
                    <td>
                    <?php foreach ($rescate_id_estu as $datos_estu) { ?>
                    <div><strong class="text-info">NOMBRE DEL ESTUDIANTE:</strong>  <?php echo $datos_estu['nombre_estu'].' '.$datos_estu['paterno_estu'].' '.$datos_estu['materno_estu']; ?></div><br>
                    <strong class="text-info">TITULO PROYECTO: </strong>
                     <div><?php echo $datos_estu['titulo_proy']?>  </div><br>
                    <strong class="text-info">AREA:</strong>
                    <?php $area = $model->datos_area($datos_estu['idestudiante']);
                    foreach ($area as $datos_area){?>
                    <div><?php echo $datos_area['nombre_area']; ?> </div>
                    <?php } ?><br>
                    <?php $estudiante = $model->rescate_datos_estu($datos_estu['idestudiante']);
                    foreach ($estudiante as $datos){ ?>              
                    <div> <strong class="text-info">CARRERA:</strong> <?php echo $datos['nombre_carrera']; ?></div><br>
                    <div> <strong class="text-info">TIPO DE MODALIDAD:</strong> <?php echo $datos['nombre_mod']; ?> </div><br>
                    <div> <strong class="text-info">NOMBRE TUTOR:</strong> <?php echo $datos['nombre_doc'].' '.$datos['paterno_doc'].' '.$datos['materno_doc']; ?> </div><br>
                    <?php  } ?>
                    <?php } ?>
                    </td>
                </tr>    
                </div>

                <div class="well">
                    <table class="table table-striped">
                    <tr class="text-lefth info">
                        <td>
                        <strong>TRIBUNALES ASIGNADOS:</strong>
                        <?php ?>
                        <?php
                        //$model_prof = new AsignacionRegistroForm();
                        foreach ($rescate_id_estu as $id_titulo_asig )
                        {
                            
                        $model_prof = AsignacionRegistroForm::lista_profe_asignados($id_titulo_asig['idproyecto']);
                        ?>
                        <div>
                                
                                <?php foreach ($model_prof as $datos_prof) { ?>
                                    <div> - <?php echo $datos_prof['nombre_doc'] ?></div>
                                <?php } ?>
                            </div> 
                         <?php } ?>
                        <?php ?>
                        </td>
                    </tr>    
                    </table>  
                </div>
                
            </div>
            <div class="col-lg-1"></div>
            
        </div>
</div>
</div> 
                <?php ?>
                <?php ?>
                <?php ?>