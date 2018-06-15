<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol_menu".
 *
 * @property integer $idrol_menu
 * @property integer $rol_idrol
 * @property integer $menu_idmenu
 *
 * @property Menu $menuIdmenu
 * @property Rol $rolIdrol
 */
class RolMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rol_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rol_idrol', 'menu_idmenu'], 'required'],
            [['rol_idrol', 'menu_idmenu'], 'integer'],
            [['menu_idmenu'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['menu_idmenu' => 'idmenu']],
            [['rol_idrol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol_idrol' => 'idrol']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrol_menu' => 'Idrol Menu',
            'rol_idrol' => 'Rol Idrol',
            'menu_idmenu' => 'Menu Idmenu',
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
    public function getRolIdrol()
    {
        return $this->hasOne(Rol::className(), ['idrol' => 'rol_idrol']);
    }
    /*
     * funcion para recuperar de informacion 
     * a la base de datos
     */
    public function listaRolMenu($id){        
        $sql = Yii::$app->db->createCommand('
        SELECT * 
        FROM rol INNER JOIN rol_menu on rol.idrol = rol_menu.rol_idrol 
        WHERE rol_idrol = :rol_id_rol')
                ->bindValue(':rol_id_rol', $id)
                ->queryAll();
        return $sql;
    }
    /*
     * funcion para la eliminar la informacion 
     * a la base de datos
     */
    public function rolMenu_eliminar($id_rol_menu){
        
        $sql = Yii::$app->db->createCommand('delete from 
	rol_menu
        where 
	idrol_menu = :id_rol_menu')
                ->bindValue(':id_rol_menu', $id_rol_menu)
                ->execute();
        return $sql;
    }
}
