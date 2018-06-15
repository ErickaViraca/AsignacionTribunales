<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usr_rol".
 *
 * @property integer $idusr_rol
 * @property integer $usuario_idusuario
 * @property integer $rol_idrol
 *
 * @property Carrera[] $carreras
 * @property Rol $rolIdrol
 * @property Usuario $usuarioIdusuario
 */
class UsrRol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usr_rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_idusuario', 'rol_idrol'], 'required'],
            [['usuario_idusuario', 'rol_idrol'], 'integer'],
            [['rol_idrol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol_idrol' => 'idrol']],
            [['usuario_idusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_idusuario' => 'idusuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idusr_rol' => 'Idusr Rol',
            'usuario_idusuario' => 'Usuario Idusuario',
            'rol_idrol' => 'Rol Idrol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarreras()
    {
        return $this->hasMany(Carrera::className(), ['usr_rol_idusr_rol' => 'idusr_rol', 'usr_rol_usuario_idusuario' => 'usuario_idusuario', 'usr_rol_rol_idrol' => 'rol_idrol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolIdrol()
    {
        return $this->hasOne(Rol::className(), ['idrol' => 'rol_idrol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIdusuario()
    {
        return $this->hasOne(Usuario::className(), ['idusuario' => 'usuario_idusuario']);
    }
}
