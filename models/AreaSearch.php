<?php
/**
 * Created by PhpStorm.
 * User: romane
 * Date: 04/06/2018
 * Time: 10:26 AM
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Area;

/**
 *  AreaSearch represents the model behind the search form about `app\models\Area`.
 */
class AreaSearch extends Area
{
  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['idarea', 'area_idarea'], 'integer'],
      [['nombre_area', 'descripcion_area'], 'safe'],
    ];
  }

  /**
   * @inheritdoc
   */
  public function scenarios()
  {
    // bypass scenarios() implementation in the parent class
    return Model::scenarios();
  }

  /**
   * Creates data provider instance with search query applied
   *
   * @param array $params
   *
   * @return ActiveDataProvider
   */
  public function search($params)
  {
    $query = Area::find();

    // add conditions that should always apply here

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);

    $this->load($params);

    if (!$this->validate()) {
      return $dataProvider;
    }

    // grid filtering conditions
    $query->andFilterWhere([
      'idarea' => $this->idarea,
    ]);

    $query->andFilterWhere(['like', 'nombre_area', $this->nombre_area])
      ->andFilterWhere(['like', 'descripcion_area', $this->descripcion_area])
      ->andFilterWhere(['like', 'area_idarea', $this->area_idarea]);

    return $dataProvider;
  }
}
