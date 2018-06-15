<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UsrRol;

/**
 * UsrRolSearch represents the model behind the search form about `app\models\UsrRol`.
 */
class UsrRolSearch extends UsrRol
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idusr_rol', 'usuario_idusuario', 'rol_idrol'], 'integer'],
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
        $query = UsrRol::find();

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
            'idusr_rol' => $this->idusr_rol,
            'usuario_idusuario' => $this->usuario_idusuario,
            'rol_idrol' => $this->rol_idrol,
        ]);

        return $dataProvider;
    }
}
