<?php

namespace app\modules\empleado\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\empleado\models\Empleado;

/**
 * EmpleadoSearch represents the model behind the search form about `app\modules\empleado\models\Empleado`.
 */
class EmpleadoSearch extends Empleado
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_empleado', 'id_ciudad'], 'integer'],
            [['nombre', 'apellido_p', 'apellido_m', 'cedula_identidad', 'telefono', 'direccion'], 'safe'],
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
        $query = Empleado::find();

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
            'id_empleado' => $this->id_empleado,
            'id_ciudad' => $this->id_ciudad,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido_p', $this->apellido_p])
            ->andFilterWhere(['like', 'apellido_m', $this->apellido_m])
            ->andFilterWhere(['like', 'cedula_identidad', $this->cedula_identidad])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'direccion', $this->direccion]);

        return $dataProvider;
    }
}
