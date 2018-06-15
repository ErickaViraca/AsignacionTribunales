<?php

namespace app\models;

use Yii;
use yii\data\SqlDataProvider;

/**
 * This is the model class for table "rol".
 *
 * @property integer $idrol
 * @property string $nombre_rol
 *
 * @property RolMenu[] $rolMenus
 * @property UsrRol[] $usrRols
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $id_menu;
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_rol', 'id_menu'], 'required'],
            [['nombre_rol'], 'string', 'max' => 45],
            /*validar campos */
            [['nombre_rol'],'string','min'=>5,'max'=>40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrol' => 'Idrol',
            'nombre_rol' => 'Nombre',
            'id_menu'=>'Seleccionar Acceso',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolMenus()
    {
        return $this->hasMany(RolMenu::className(), ['rol_idrol' => 'idrol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsrRols()
    {
        return $this->hasMany(UsrRol::className(), ['rol_idrol' => 'idrol']);
    }
    public function obtenerFormulario($id_rol){
             $db = Yii::$app->db;
        $nombreMenuPadre = $db->createCommand('
        SELECT * 
        FROM 
	rol 
	INNER JOIN rol_menu ON rol.idrol = rol_menu.rol_idrol 
	INNER JOIN menu ON rol_menu.menu_idmenu = menu.idmenu
        WHERE idrol = :id_rol ')
                ->bindValue(':id_rol', $id_rol)
                ->queryAll();
        return $nombreMenuPadre;
        }
    /*lista de roles*/
    public function rol_lista() {

        $db = Yii::$app->db;
        $count = $db->createCommand('select 
	COUNT(*)
        from 
	rol r 
	INNER JOIN rol_menu rm on rm.rol_idrol = r.idrol 
	INNER JOIN menu m on rm.menu_idmenu = m.idmenu 
        order by 
	idrol desc
        ')->queryScalar();
        $provider = new SqlDataProvider([
            'sql' => 'select 
	r.*, 
	m.*, 
	rm.* 
        from 
	rol r 
	INNER JOIN rol_menu rm on rm.rol_idrol = r.idrol 
	INNER JOIN menu m on rm.menu_idmenu = m.idmenu 
        order by 
	idrol desc',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'attributes' => [
                    'nombre',
                //'apellido_ps',
                //'apellido_m'
                ],
            ],
        ]);
        return $provider;
    }
    /*funcion para eliminar datos*/
    public function rol_eliminar($model){
         $params= ':id_rol';
        $sql = Yii::$app->db->createCommand('call rol_eliminar(' . $params . ')')
                ->bindValue(':id_rol', $model->idrol)
                ->execute();
        return $sql;
    }

}
