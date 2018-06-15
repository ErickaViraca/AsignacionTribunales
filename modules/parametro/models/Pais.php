<?php

namespace app\modules\parametro\models;
use yii\data\SqlDataProvider;
use Yii;

/**
 * This is the model class for table "pais".
 *
 * @property integer $id_pais
 * @property string $codigo
 * @property string $nombre
 * @property boolean $activo
 *
 * @property Ciudad[] $ciudads
 */
class Pais extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pais';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['codigo', 'nombre'], 'required', 'message' => 'no puede ser en blanco '],
            [['activo'], 'boolean'],
            [['codigo', 'nombre'], 'string', 'max' => 45],
//array('NOMBRE_USR, APELLIDO_P_USR, APELLIDO_M_USR, CEDULA_IDENTIDAD_USR','filter','filter'=>'strtoupper'),
//            [['nombre'],'filter', 'filter'=>'strtoupper'],
//            [['nombre'], 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras '],
//            [['codigo'],'integer', 'message' => 'Solo acepta valor numerico'],
//            ['nombre', 'unique', 'message' => ' ya ha sido tomada '],
            
            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pais' => 'Id Pais',
            'codigo' => 'Codigo',
            'nombre' => 'Nombre',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCiudads()
    {
        return $this->hasMany(Ciudad::className(), ['id_pais' => 'id_pais']);
    }
    /*
     * funcion para convertir a mayuscula 
     */
//    protected function beforeSave(){
//
//        //DE FORMA INDIVIDUAL
//       // $this->nombre = strtoupper($this->nombre);
//
//        //TODOS LOS ATRIBUTOS    
//        $this->attributes = array_map('strtoupper',$this->attributes);
//
//        return parent::beforeSave();
//    }
    /*
     * funcion para recuperar los datos de la base de datos
     */
    public function param_pais_get(){
        $db = Yii::$app->db;
        $count = $db->createCommand('select COUNT(*) from param_pais_get()')->queryScalar();
        $provider = new SqlDataProvider([
            'sql' => 'select * from param_pais_get()',
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
    public function param_pais_insert($model){
        $params= ':codigos, :nombres, :activos';
        Yii::$app->db->createCommand('select * from param_pais_insert(' . $params . ')')
                ->bindValue(':codigos', $model->codigo)
                ->bindValue(':nombres', $model->nombre)
                ->bindValue(':activos', $model->activo)
                ->execute();
    }
    /*
     * funcion para la actualizacion de informacion 
     * a la base de datos
     */
    public function param_pais_update($model){
        $params= ':id_paises,:codigos, :nombres, :activos';
        $sql = Yii::$app->db->createCommand('select * from param_pais_update(' . $params . ')')
                ->bindValue(':id_paises', $model->id_pais)
                ->bindValue(':codigos', $model->codigo)
                ->bindValue(':nombres', $model->nombre)
                ->bindValue(':activos', $model->activo)
                ->queryAll();
        return $sql;
    }
    /*
     * funcion para la eliminar la informacion 
     * a la base de datos
     */
    public function param_pais_delete($model){
         $params= ':id_paises';
        $sql = Yii::$app->db->createCommand('select * from param_pais_delete(' . $params . ')')
                ->bindValue(':id_paises', $model->id_pais)
                ->execute();
        return $sql;
    }
    public function param_status_pais($model){
        $params= ':id_p, :activo_p';
        $sql = Yii::$app->db->createCommand('select * from param_status_pais(' . $params . ')')
                ->bindValue(':id_p', $model->id_pais)
                ->bindValue(':activo_p', $model->activo)
                ->execute();
        return $sql;
    }
    /*
     * funcion para devolver las ciudades asociados 
     * a un paises
     */
    public function param_get_status_pais($activo){
        $params= ':activo_p';
        $sql = Yii::$app->db->createCommand('select * from param_get_status_pais(' . $params . ')')
                ->bindValue(':activo_p', $activo)
                ->queryAll();
        return $sql;
    }
    /*
     * funcion para obtener bajo el nombre de la pais
     */
    public function param_pais_get_nombre($nombre ){
         
//         echo $nombre;
//         die();
         $params= ':nombre_p';
         $db = Yii::$app->db;
         $sql = Yii::$app->db->createCommand('select * from param_pais_get_nombre('.$params.')')
         ->bindValue(':nombre_p',$nombre)
         ->queryOne(); 
          //print_r($sql);
           echo  json_encode($sql);
//           echo 'HOLA';
//           die();
    }
    
}
