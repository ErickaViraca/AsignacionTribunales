<?php

namespace app\modules\empleado\models;
/*se importa ciudad para poder hacer la comunicion de la relacion de la tabla*/
use app\modules\parametro\models\Ciudad;
use Yii;
use yii\data\SqlDataProvider;
use yii\helpers\Json;


/**
 * This is the model class for table "empleado".
 *
 * @property integer $id_empleado
 * @property string $nombre
 * @property string $apellido_p
 * @property string $apellido_m
 * @property string $cedula_identidad
 * @property string $telefono
 * @property string $direccion
 * @property integer $id_ciudad
 *
 * @property Ciudad $idCiudad
 */
class Empleado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $pais;
    public static function tableName()
    {
        return 'empleado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido_p', 'apellido_m', 'cedula_identidad', 'direccion','id_ciudad', 'pais'], 'required', 'message' => 'no puede ser en blanco '],
            [['nombre','apellido_p', 'apellido_m', 'cedula_identidad', 'direccion'], 'filter',  'filter'=>'strtoupper'],
            [['nombre', 'apellido_p', 'apellido_m',], 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras '],
            [['id_ciudad',  'pais'], 'integer'],
            [['nombre', 'apellido_p', 'apellido_m', 'cedula_identidad', 'telefono'], 'string', 'max' => 45],
            //['telefono', 'match', 'pattern'=>"/^.{8,8}$/", 'message' => 'Mínimo 7 y máximo 7 '],
            //['cedula_identidad', 'unique', 'message' => 'la cedula de identidad ya ha sido tomada '],
            
            [['direccion'], 'string', 'max' => 90],
            //[['foto'], 'string', 'max' => 250],
            [['imagen'], 'string', 'max' => 250],
//            [['imagen'], 'string', 'max' => 250],
            [['id_ciudad'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudad::className(), 'targetAttribute' => ['id_ciudad' => 'id_ciudad']],
            //[['telefono'],'integer', 'message' => 'Solo acepta valor numerico'],
            //[['foto'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 500*500],
             //[[ 'imagen' ], 'file' , 'skipOnEmpty' => false , 'extensions' => 'png, jpg' ],
//            [['image'], 'safe'],
//            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
//            [['image'], 'file', 'maxSize'=>'100000'],
//             [['foto', 'foto'], 'string', 'max' => 100],
            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_empleado' => 'Id Empleado',
            'nombre' => 'Nombre',
            'apellido_p' => 'Apellido P',
            'apellido_m' => 'Apellido M',
            'cedula_identidad' => 'Cedula Identidad',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'id_ciudad' => 'Ciudad',
            'foto'=>'foto',
            'imagen'=>'imagen',
            //'imagen'=>'imagen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCiudad()
    {
        return $this->hasOne(Ciudad::className(), ['id_ciudad' => 'id_ciudad']);
    }
    
    /*
     * funcion para obtener la lista
     * de empleados de la base de datos
     */
    
    public function empleado_get(){
        
        $db = Yii::$app->db;
        $count = $db->createCommand('select COUNT(*) from empleado_get()')->queryScalar();
        $provider = new SqlDataProvider([
            'sql' => 'select * from empleado_get()',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 5,
            ],
                'sort' => [
                'attributes' => [ 
                    'nombres',
                    //'apellido_ps',
                    //'apellido_m'
                ],
            ],
        ]);
        return $provider;
    }
    /*
     *funcion de prueba 
     */
    public function prueba($id_empleado){
        $params= ':id_emp';
        $sql = Yii::$app->db->createCommand('select * from empleado_prueba(' . $params . ')')
                ->bindValue(':id_emp', $id_empleado)
                ->queryAll();
       // print_r($sql);
        echo JSON::encode($sql);
        
    }
    
    
    /*
     * funcion para la insercion de informacion 
     * a la base de datos
     */
    public function empleado_insert($model){
//        echo "hoal como estas";
//        echo "<pre>";
//        print_r($model);
//        echo "</pre>";
//        die();
        $params= ':nombres, :apellido_ps, :apellido_ms, :ci, :telefonos, :direcciones, :id_ciudades, :foto_e, :imagen_e';
        Yii::$app->db->createCommand('select * from empleado_insert(' . $params . ')')
                ->bindValue(':nombres', $model->nombre)
                ->bindValue(':apellido_ps', $model->apellido_p)
                ->bindValue(':apellido_ms', $model->apellido_m)
                ->bindValue(':ci', $model->cedula_identidad)
                ->bindValue(':telefonos', $model->telefono)
                ->bindValue(':direcciones', $model->direccion)
                ->bindValue(':id_ciudades', $model->id_ciudad)
                ->bindValue(':foto_e', $model->foto)
                ->bindValue(':imagen_e', $model->imagen)
                ->execute();
    }
    /*
     * funcion para la actualizacion de informacion 
     * a la base de datos
     */
    public function empleado_update($model){
        $params= ':id_empleados,:nombres,:apellido_ps, :apellido_ms, :ci, :telefonos, :direcciones, :id_ciudades, :imagen_e';
        $sql = Yii::$app->db->createCommand('select * from empleado_update(' . $params . ')')
                ->bindValue(':id_empleados', $model->id_empleado)
                ->bindValue(':nombres', $model->nombre)
                ->bindValue(':apellido_ps', $model->apellido_p)
                ->bindValue(':apellido_ms', $model->apellido_m)
                ->bindValue(':ci', $model->cedula_identidad)
                ->bindValue(':telefonos', $model->telefono)
                ->bindValue(':direcciones', $model->direccion)
                ->bindValue(':id_ciudades', $model->id_ciudad)
                ->bindValue(':imagen_e', $model->imagen)
                ->queryAll();
        return $sql;
    }
    /*
     * funcion para la eliminar la informacion 
     * a la base de datos
     */
    public function empleado_delete($model){
         $params= ':id_empleados';
        $sql = Yii::$app->db->createCommand('select * from empleado_delete(' . $params . ')')
                ->bindValue(':id_empleados', $model->id_empleado)
                ->execute();
        return $sql;
    }
    /*
     * funcion para la prueba la informacion 
     * a la base de datos
     */
    public function empleado_prueba($id){
//       echo $id;
        $params= ':id_empleados';
        $sql = Yii::$app->db->createCommand('select * from empleado_prueba(' . $params . ')')
                ->bindValue(':id_empleados', $id)
                ->queryScalar();
        return $sql;
//        print_r($sql);
//        die();
    }
    
    
}
