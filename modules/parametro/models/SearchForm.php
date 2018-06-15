<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\parametro\models;
use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
use app\modules\parametro\models\Empleado;
/**
 * Description of SearchForm
 *
 * @author MIS DOCUMENTOS
 */
class SearchForm  extends Model {
    //put your code here
    public $palabraBuscar;   
     public function rules()
    {
         return [
//            [['palabraBuscar'], 'required' , 'message' => 'no puede ser en blanco '],
//            ['palabraBuscar', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras '],
             [['palabraBuscar'], 'filter',  'filter'=>'strtoupper'],
             [['palabraBuscar'], 'string', 'max' => 250],
             ];
        
    }
    /*
     * definir los label con el que aparezca
     */
     public function attributeLabels()
    {
        return [
            'palabraBuscar' => 'BUSQUEDAS',            
        ];
    }
    /*
     * funcion para la busqueda con un
     * procedimiento almacenado desde la 
     * basa de datos
     */
    public function param_search_pais($model){
        $params = ':palabra_buscar';
        $count = Yii::$app->db->createCommand('
        SELECT COUNT(*) FROM param_pais_search('.$params.')')
                ->bindValue(':palabra_buscar', $model->palabraBuscar)
//                ->execute();
                ->queryScalar();

        $provider = new SqlDataProvider([
            'sql' => 'SELECT * FROM param_pais_search('.$params.')',
            'params' => [':palabra_buscar' => $model->palabraBuscar],
            'totalCount' => $count,
            'pagination' => [
            'pageSize' => 10,
            ],
        ]);
        return $provider;
    }
    /*
     * funcion la para busqueda de cuidad en la base de datos
     */
    public function param_ciudad_search($model){
        $params = ':palabra_buscar';
        $count = Yii::$app->db->createCommand('
        SELECT COUNT(*) FROM param_ciudad_search('.$params.')')
                ->bindValue(':palabra_buscar', $model->palabraBuscar)
//                ->execute();
                ->queryScalar();

        $provider = new SqlDataProvider([
            'sql' => 'SELECT * FROM param_ciudad_search('.$params.')',
            'params' => [':palabra_buscar' => $model->palabraBuscar],
            'totalCount' => $count,
            'pagination' => [
            'pageSize' => 10,
            ],
        ]);
        return $provider;
    }
    /*
     * funcion la para busqueda de cuidad en la base de datos
     */
    public function empleado_search($model){
        $params = ':palabra_buscar';
        $count = Yii::$app->db->createCommand('
        SELECT COUNT(*) FROM empleado_search('.$params.')')
                ->bindValue(':palabra_buscar', $model->palabraBuscar)
//                ->execute();
                ->queryScalar();

        $provider = new SqlDataProvider([
            'sql' => 'SELECT * FROM empleado_search('.$params.')',
            'params' => [':palabra_buscar' => $model->palabraBuscar],
            'totalCount' => $count,
            'pagination' => [
            'pageSize' => 10,
            ],
        ]);
        return $provider;
    }
}
