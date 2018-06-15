<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form about `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idusuario', 'celular_usr', 'activate'], 'integer'],
            [['nombre_usr', 'apellido_paterno_usr', 'apellido_materno_usr', 'correo_usr', 'usuario', 'contrasenia', 'conf_contrasenia', 'accessToken'], 'safe'],
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
        $query = Usuario::find();

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
            'idusuario' => $this->idusuario,
            'celular_usr' => $this->celular_usr,
            'activate' => $this->activate,
        ]);

        $query->andFilterWhere(['like', 'nombre_usr', $this->nombre_usr])
            ->andFilterWhere(['like', 'apellido_paterno_usr', $this->apellido_paterno_usr])
            ->andFilterWhere(['like', 'apellido_materno_usr', $this->apellido_materno_usr])
            ->andFilterWhere(['like', 'correo_usr', $this->correo_usr])
            ->andFilterWhere(['like', 'usuario', $this->usuario])
            ->andFilterWhere(['like', 'contrasenia', $this->contrasenia])
            ->andFilterWhere(['like', 'conf_contrasenia', $this->conf_contrasenia])
            ->andFilterWhere(['like', 'accessToken', $this->accessToken]);

        return $dataProvider;
    }
}
