<?php

namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Preregistro;

/**
 * PreregistroSearch represents the model behind the search form of `common\models\Preregistro`.
 */
class PreregistroSearch extends Preregistro
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ingenieria_id', 'estado_registro_id'], 'integer'],
            [['nombre', 'matricula', 'email', 'kardex', 'constancia_ingles', 'constancia_servicio_social', 'constancia_creditos_complementarios', 'created_at', 'updated_at', 'comentario'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Preregistro::find();

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
            'id' => $this->id,
            'ingenieria_id' => $this->ingenieria_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'estado_registro_id' => $this->estado_registro_id,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'matricula', $this->matricula])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'kardex', $this->kardex])
            ->andFilterWhere(['like', 'constancia_ingles', $this->constancia_ingles])
            ->andFilterWhere(['like', 'constancia_servicio_social', $this->constancia_servicio_social])
            ->andFilterWhere(['like', 'constancia_creditos_complementarios', $this->constancia_creditos_complementarios])
            ->andFilterWhere(['like', 'comentario', $this->comentario]);

        return $dataProvider;
    }
}
