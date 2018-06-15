<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "menu".
 *
 * @property integer $idmenu
 * @property string $nombre_menu
 * @property string $url_menu
 * @property integer $menu_idmenu
 *
 * @property Menu $menuIdmenu
 * @property Menu[] $menus
 * @property RolMenu[] $rolMenus
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_menu', 'url_menu'], 'required'],
            [['menu_idmenu'], 'integer'],
            [['nombre_menu'], 'string', 'max' => 100],
            [['url_menu'], 'string', 'max' => 45],
            [['menu_idmenu'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['menu_idmenu' => 'idmenu']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmenu' => 'Idmenu',
            'nombre_menu' => 'Nombre Menu',
            'url_menu' => 'Url Menu',
            'menu_idmenu' => 'Menu Idmenu',
            'id_menu'=>'id_menu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuIdmenu()
    {
        return $this->hasOne(Menu::className(), ['idmenu' => 'menu_idmenu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['menu_idmenu' => 'idmenu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolMenus()
    {
        return $this->hasMany(RolMenu::className(), ['menu_idmenu' => 'idmenu']);
    }
    /*funcion para obtener la lista menu todo los que son padre */
    public static function getListaMenu() {
        //return CHtml::listData(Formulario::model()->findAll('FORMULARIO_ID_FORMULARIO is null'), 'ID_FORMULARIO', 'NOMBRE_FORM');
         $menu = Menu::obtenerListaPadre();
        return ArrayHelper::map($menu, 'idmenu', 'nombre_menu'); 
    }
    public function obtenerListaPadre(){
        $db = Yii::$app->db;
        $count = $db->createCommand('SELECT * FROM menu WHERE menu_idmenu is null ')->queryAll();
        return $count;
    }
    /*
     * funcion para obtener los hijos de formulario
     */
    public function obtenerFormuHijo($id_menu){
        
        $db = Yii::$app->db;
        $nombreMenuPadre = $db->createCommand('
        SELECT * FROM menu WHERE menu_idmenu= :id_menu ')
                ->bindValue(':id_menu', $id_menu)
                ->queryAll();
        return $nombreMenuPadre;
    }
    
}
