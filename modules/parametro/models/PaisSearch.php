<?php

namespace app\modules\parametro\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\parametro\models\Pais;

/**
 * PaisSearch represents the model behind the search form about `app\modules\parametro\models\Pais`.
 */
class PaisSearch extends Pais
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pais'], 'integer'],
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
        $query = Pais::find();

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
            'id_pais' => $this->id_pais,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
