<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components\widgets;
use yii\base\Widget;
use app\models\Usuario;
use app\models\Rol;
use app\models\Menu;
use Yii;

/**
 * Description of userMenu
 *
 * @author MIS DOCUMENTOS
 */
class userMenu extends Widget {
    //put your code here
    
    public $title;
   
    public function getRecentRoles(){
        return Usuario::obtenerNombreRoles(Yii::$app->user->identity->id);
    }
    public function getFormulario($id_rol){
        return Rol::model()->getFormulario($id_rol);
    }
    public function obtenerFormulario($id_rol){
        return Rol::obtenerFormulario($id_rol);
    }
    
    public function obtenerFormuHijo($id_formu_padre){
        return Menu::obtenerFormuHijo($id_formu_padre);
    }
    public function getTipoModalidad($id_carrera){
        return Carrera::model()->getTipoModalidad($id_carrera);
    }
    
    
    
    
    public function run()
    {
        
        return $this->render('userMenu');
    }
}
