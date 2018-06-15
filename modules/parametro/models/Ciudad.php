<?php

namespace app\modules\parametro\models;
use yii\data\SqlDataProvider;

use Yii;

/**
 * This is the model class for table "ciudad".
 *
 * @property integer $id_ciudad
 * @property string $codigo
 * @property string $nombre
 * @property boolean $activo
 * @property integer $id_pais
 *
 * @property Pais $idPais
 * @property Empleado[] $empleados
 */
class Ciudad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ciudad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'id_pais'], 'required', 'message' => 'no puede ser en blanco '],
            [['activo'], 'boolean'],
            [['id_pais'], 'integer'],
            [['codigo', 'nombre'], 'string', 'max' => 45],
            [['id_pais'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::className(), 'targetAttribute' => ['id_pais' => 'id_pais']],
            [['nombre'],'filter', 'filter'=>'strtoupper'],
            [['nombre'], 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras '],
            [['codigo'],'integer', 'message' => 'Solo acepta valor numerico'],
            ['nombre', 'unique', 'message' => ' ya ha sido tomada '],
            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ciudad' => 'Id Ciudad',
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'activo' => 'Activo',
            'id_pais' => 'Id Pais',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPais()
    {
        return $this->hasOne(Pais::className(), ['id_pais' => 'id_pais']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleado::className(), ['id_ciudad' => 'id_ciudad']);
    }
    /*
     * funcion para recuperar los datos de la base de datos
     */
    public function param_ciudad_get(){
        $db = Yii::$app->db;
        $count = $db->createCommand('select COUNT(*) from param_ciudad_get()')->queryScalar();
        $provider = new SqlDataProvider([
            'sql' => 'select * from param_ciudad_get()',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 3,
            ],
                'sort' => [
                'attributes' => [ 
//                    'nombres',
//                    'apellido_p',
//                    'apellido_m'
                ],
            ],
        ]);
        return $provider;
    }
    /*
     * funcion para la insercion de informacion 
     * a la base de datos
     */
    public function param_ciudad_insert($model){
        $params= ':codigos, :nombres, :activos, :id_paises';
        Yii::$app->db->createCommand('select * from param_ciudad_insert(' . $params . ')')
                ->bindValue(':codigos', $model->codigo)
                ->bindValue(':nombres', $model->nombre)
                ->bindValue(':activos', $model->activo)
                ->bindValue(':id_paises', $model->id_pais)
                ->execute();
    }
    /*
     * funcion para la actualizacion de informacion 
     * a la base de datos
     */
    public function param_ciudad_update($model){
        $params= ':id_ciudades,:codigos, :nombres, :activos, :id_paises';
        $sql = Yii::$app->db->createCommand('select * from param_ciudad_update(' . $params . ')')
                ->bindValue(':id_ciudades', $model->id_ciudad)
                ->bindValue(':codigos', $model->codigo)
                ->bindValue(':nombres', $model->nombre)
                ->bindValue(':activos', $model->activo)
                ->bindValue(':id_paises', $model->id_pais)
                ->queryAll();
        return $sql;
    }
    /*
     * funcion para la eliminar la informacion 
     * a la base de datos
     */
    public function param_ciudad_delete($model){
         $params= ':id_ciudades';
        $sql = Yii::$app->db->createCommand('select * from param_ciudad_delete(' . $params . ')')
                ->bindValue(':id_ciudades', $model->id_ciudad)
                ->execute();
        return $sql;
    }
    public function param_status_ciudad($model){
        $params= ':id_c, :activo_c';
        $sql = Yii::$app->db->createCommand('select * from param_status_ciudad(' . $params . ')')
                ->bindValue(':id_c', $model->id_ciudad)
                ->bindValue(':activo_c', $model->activo)
                ->execute();
        return $sql;
    }
    /*
     * funcion para devolver las ciudades asociados 
     * a un paises
     */
    public function param_get_ciudades_pais($id_pais){
        $params= ':id_p';
        $sql = Yii::$app->db->createCommand('select * from param_get_ciudades_pais(' . $params . ')')
                ->bindValue(':id_p', $id_pais)
                ->queryAll();
        return $sql;
    }
    /*
     * funcion para obtener bajo el nombre de la ciudad 
     */
    public function param_ciudad_get_nombre($nombre){
         
//         echo $nombre;
//         die();
         $params= ':nombre_ciudad';
         $db = Yii::$app->db;
         $sql = Yii::$app->db->createCommand('select * from param_ciudad_get_nombre('.$params.')')
         ->bindValue(':nombre_ciudad',$nombre)
         ->queryOne(); 
          //print_r($sql);          
           echo  json_encode($sql);
          // echo 'HOLA';
           //die();
    }
    
}

