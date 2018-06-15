<?php 
use yii\helpers\BaseUrl;

?>
<ul class="nav nav-pills nav-stacked list-group">
    <li class="active "><a href="#">MENU</a></li>
<!--    <li class="dropdown list-group-item">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">-->
<!--            <span class="glyphicon glyphicon-chevron-right">&nbsp;</span> REGISTRO DE MODALIDAD: <span class="caret"></span></a>
        <ul class="dropdown-menu list-group">-->
            <?php
//            $nombre_carrera = Carrera::model()->findAll();
//            foreach ($nombre_carrera as $nombre) {
//                ?>

<!--                <li class="list-group-item">
                    <a href="//<?php // echo Yii::app()->createUrl('carreraTM/seleccionTM', array('idCarrera' => $nombre->ID_CARRERA))?>"><span class="glyphicon glyphicon-user"></span> <?php // echo $nombre->NOMBRE_CARRERA ?></a>
                    <?php //  echo CHtml::link($nombre->NOMBRE_CARRERA, Yii::app()->createUrl('carreraTm/seleccionTM', array('idCarrera' => $nombre->ID_CARRERA))); ?>
                </li>-->
            <?php // } ?> 
        <!--</ul>-->                        
    <!--</li>-->
    <!--2-->
  
    <?php 
    $nombre_rol = app\components\widgets\userMenu::getRecentRoles();
//    print_r($model);
    foreach ($nombre_rol as $usuarios){
       //echo $usuarios['idrol'];
       $nombre_menu= app\components\widgets\userMenu::obtenerFormulario($usuarios['idrol']);
       
       foreach ($nombre_menu as $formularioPadre){
         // print_r($formularioPadre);
           //echo $formularioPadre['url_menu'];
                $controlador = Yii::$app->controller->id;
                $direccion = $formularioPadre['url_menu'];
                $direccion = substr($direccion, 1, strlen($direccion));
                $palabra = explode("/", $direccion);
                $active = '';
                if ($controlador == $palabra[0]) {
                    $active = 'class="active"';
                }
    ?>
    <li class="dropdown list-group-item">
        <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo Yii::$app->request->baseUrl . $formularioPadre['url_menu']; ?>">
        <span class="glyphicon glyphicon-chevron-right">&nbsp;</span> <?php echo $formularioPadre['nombre_menu']; ?> <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <?php $nombre_menu_id= app\components\widgets\userMenu::obtenerFormuHijo($formularioPadre['idmenu']);
           // print_r($nombre_menu_id);
            ?>
            <?php   foreach ($nombre_menu_id as $formuHijo) { ?>
                 <li class="list-group-item">

                <a <?php echo (Yii::$app->request->url == Yii::$app->homeUrl . $formuHijo['url_menu']) ? $active : ''; ?> href="<?php echo Yii::$app->request->baseUrl . $formuHijo['url_menu']; ?>"><?php  echo $formuHijo['nombre_menu']; ?></a>                                    
               
                </li>
            <?php   } ?>
        </ul>
    </li>
    
    <?php } ?>
    <?php } ?>
           
            
  
    
</ul>

