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
use app\models\Docente;

/**
 *  DocenteSearch represents the model behind the search form about `app\models\Usuario`.
 */
class DocenteSearch extends Docente
{
  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['iddocente', 'ci_doc', 'cod_sis_doc'], 'integer'],
      [['nombre_doc', 'paterno_doc', 'materno_doc', 'correo_doc', 'titulo_doc', 'carga_horaria_doc'], 'safe'],
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
    $query = Docente::find();

    // add conditions that should always apply here

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);

    $this->load($params);

    if (!$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    // grid filtering conditions
    $query->andFilterWhere([
      'iddocente' => $this->iddocente,
      'correo_doc' => $this->correo_doc,
    ]);

    $query->andFilterWhere(['like', 'nombre_doc', $this->nombre_doc])
      ->andFilterWhere(['like', 'paterno_doc', $this->paterno_doc])
      ->andFilterWhere(['like', 'materno_doc', $this->materno_doc])
      ->andFilterWhere(['like', 'titulo_doc', $this->titulo_doc])
      ->andFilterWhere(['like', 'telefono_doc', $this->telefono_doc])
      ->andFilterWhere(['like', 'ci_doc', $this->ci_doc])
      ->andFilterWhere(['like', 'cod_sis_doc', $this->cod_sis_doc]);

    return $dataProvider;
  }
}
