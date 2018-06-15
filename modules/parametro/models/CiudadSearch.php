<?php

namespace app\modules\parametro\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\parametro\models\Ciudad;

/**
 * CiudadSearch represents the model behind the search form about `app\modules\parametro\models\Ciudad`.
 */
class CiudadSearch extends Ciudad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ciudad', 'id_pais'], 'integer'],
            [['codigo', 'nombre'], 'safe'],
            [['activo'], 'boolean'],
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
        $query = Ciudad::find();

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
            'id_ciudad' => $this->id_ciudad,
            'activo' => $this->activo,
            'id_pais' => $this->id_pais,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
