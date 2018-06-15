<?php
/**
 * Created by PhpStorm.
 * User: romane
 * Date: 04/06/2018
 * Time: 12:02 AM
 */

namespace app\models;

use Yii;
use yii\data\SqlDataProvider;

/**
 * This is the model class for table "area".
 *
 * @property integer $idarea
 * @property string $nombre_area
 * @property string $descripcion_area
 * @property string $area_idarea
 */
class Area extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'area';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['nombre_area', 'descripcion_area'], 'required'],
      [['nombre_area', 'descripcion_area'], 'string'],
      [['area_idarea'], 'integer'],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'idarea' => 'Idarea',
      'nombre_area' => 'Nombre Area',
      'descripcion_area' => 'Descripcion Area',
      'area_idarea' => 'Area Idarea',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getDocArea()
  {
    return $this->hasMany(DocArea::className(), ['area_idarea' => 'idarea']);
  }

  public function area_insertar($model)
  {
    $params = ':idarea,:nombre_area, :descripcion_area, :area_idarea';
    Yii::$app->db->createCommand('call area_insertar(' . $params . ')')
      ->bindValue(':idarea', $model->idarea)
      ->bindValue(':nombre_area', $model->nombre_area)
      ->bindValue(':descripcion_area', $model->descripcion_area)
      ->bindValue(':area_idarea', $model->area_idarea)
      ->execute();
  }

  public function area_eliminar($model)
  {
    $params = ':idarea';
    $sql = Yii::$app->db->createCommand('call area_eliminar(' . $params . ')')
      ->bindValue(':idarea', $model->idarea)
      ->execute();
    return $sql;
  }

  public function lista_area(){
    $db = Yii::$app->db;
    $count = $db->createCommand('select 
	 COUNT(*)
	 from area a order by idarea DESC 
	 ')->queryScalar();
    $provider = new SqlDataProvider([
      'sql' => 'select a.*
        from area a 
        order by idarea desc',
      'totalCount' => $count,
      'pagination' => [
        'pageSize' => 5,
      ],
      'sort' => [
        'attributes' => [
          'nombre',
        ],
      ],
    ]);
    return $provider;
  }
}
