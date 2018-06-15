<?php

namespace app\models;

use Yii;
use yii\data\SqlDataProvider;
/**
 * This is the model class for table "usuario".
 *
 * @property integer $idusuario
 * @property string $nombre_usr
 * @property string $apellido_paterno_usr
 * @property string $apellido_materno_usr
 * @property integer $celular_usr
 * @property string $correo_usr
 * @property string $usuario
 * @property string $contrasenia
 * @property string $conf_contrasenia
 * @property integer $activate
 * @property string $accessToken
 *
 * @property UsrRol[] $usrRols
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
      public $id_rol;
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_usr', 'apellido_paterno_usr', 'usuario', 'contrasenia', 'conf_contrasenia', 'id_rol'], 'required'],
            [['celular_usr', 'activate'], 'integer'],
            [['nombre_usr', 'apellido_paterno_usr', 'apellido_materno_usr', 'usuario', 'contrasenia', 'conf_contrasenia'], 'string', 'max' => 45],
            [['correo_usr'], 'string', 'max' => 55],
            [['accessToken'], 'string', 'max' => 250],
            //validando correo electronico
            ['correo_usr', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
            ['correo_usr', 'email', 'message' => 'Formato no válido'],
            ['correo_usr', 'email_existe'],
            //validando usuario
            ['usuario', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            ['usuario', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['usuario', 'usuario_existe'],
            //validar la contraseña
            ['contrasenia', 'match', 'pattern' => "/^.{4,16}$/", 'message' => 'Mínimo 4 y máximo 16 caracteres'],
            ['conf_contrasenia', 'compare', 'compareAttribute' => 'contrasenia', 'message' => 'Los contraseña no coinciden'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idusuario' => 'Idusuario',
            'nombre_usr' => 'Nombre',
            'apellido_paterno_usr' => 'Paterno ',
            'apellido_materno_usr' => 'Materno ',
            'celular_usr' => 'Celular',
            'correo_usr' => 'Correo',
            'usuario' => 'Usuario',
            'contrasenia' => 'Contrasenia',
            'conf_contrasenia' => 'Conf Contrasenia',
            'activate' => 'Activate',
            'accessToken' => 'Access Token',
            'id_rol'=>'Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsrRols()
    {
        return $this->hasMany(UsrRol::className(), ['usuario_idusuario' => 'idusuario']);
    }
    /*
     * funcines para validar email existente
     */
    public function email_existe($attribute, $params)
    {
  
  //Buscar el email en la tabla
        $table = Usuario::find()->where("correo_usr=:correo_usr", [":correo_usr" => $this->correo_usr]);
  
  //Si el email existe mostrar el error
        if ($table->count() == 1)
        {
                        $this->addError($attribute, "El email seleccionado existe");
        }
    }
    /*
     * funcines para validar usuario existente
     */
    public function usuario_existe($attribute, $params)
    {
        //Buscar el username en la tabla
        $table = Usuario::find()->where("usuario=:usuario", [":usuario" => $this->usuario]);
        
        //Si el username existe mostrar el error
        if ($table->count() == 1)
        {
                        $this->addError($attribute, "El usuario seleccionado existe");
        }
    }
    /*
     * funcion para listar de usuario 
     */
    public function lista_usuario(){
        
        $db = Yii::$app->db;
        $count = $db->createCommand('select 
	 COUNT(*)
        from 
	usuario u 
	INNER JOIN usr_rol ur on ur.usuario_idusuario = u.idusuario 
	INNER JOIN rol r on ur.rol_idrol = r.idrol 
        order by 
	idusuario desc
        ')->queryScalar();
        $provider = new SqlDataProvider([
            'sql' => 'select u.*, r.*, ur.*
        from 
	usuario u 
	INNER JOIN usr_rol ur on ur.usuario_idusuario = u.idusuario 
	INNER JOIN rol r on ur.rol_idrol = r.idrol 
        order by 
	idusuario desc',
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
    /*
     * funcion para insertar en usuario
     */
    public function usuario_insertar($model){
        $params= ':id_usr,:nombre, :paterno, :materno, :cel, :email, :cuenta, :clave,:claves, :activar, :toque';
        Yii::$app->db->createCommand('call usuario_insertar(' . $params . ')')
                ->bindValue(':id_usr', $model->idusuario)
                ->bindValue(':nombre', $model->nombre_usr)
                ->bindValue(':paterno', $model->apellido_paterno_usr)
                ->bindValue(':materno', $model->apellido_materno_usr)
                ->bindValue(':cel', $model->celular_usr)
                ->bindValue(':email', $model->correo_usr)
                ->bindValue(':cuenta', $model->usuario)
                ->bindValue(':clave', $model->contrasenia)
                ->bindValue(':claves', $model->conf_contrasenia)
                ->bindValue(':activar', $model->activate)
                ->bindValue(':toque', $model->accessToken)
                ->execute();
        
    }
    public function obtenerNombreRoles($id_usuario){
        //echo $id_usuario;
        $db = Yii::$app->db;
        $nombreRol = $db->createCommand('
        SELECT * 
        FROM usuario 
	INNER JOIN usr_rol ON usuario.idusuario = usr_rol.usuario_idusuario 
	INNER JOIN rol ON usr_rol.rol_idrol = rol.idrol 
        WHERE idusuario = :id_usuario')
                ->bindValue(':id_usuario', $id_usuario)
                ->queryAll();
        return $nombreRol;
        
    }
    // CAMBIAR EL ESTADO DEL USUARIO
    public function usuario_estado($model){
        //echo"en contruccion";
        //die();
        $params= ':id_usuario, :activo_usuario';
        $sql = Yii::$app->db->createCommand('select  usuario_estado(' . $params . ')')
                ->bindValue(':id_usuario', $model->idusuario)
                ->bindValue(':activo_usuario', $model->activate)
                ->execute();
        return $sql;
    }
    /*funcion para eliminar datos*/
    public function usuario_eliminar($model){
         $params= ':id_usuario';
        $sql = Yii::$app->db->createCommand('call usuario_eliminar(' . $params . ')')
                ->bindValue(':id_usuario', $model->idusuario)
                ->execute();
        return $sql;
    }
}
