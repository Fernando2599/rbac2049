<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ajuste;

/**
 * AjusteSearch represents the model behind the search form of `common\models\Ajuste`.
 */
class AjusteSearch extends Ajuste
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'num_semanas_semestre'], 'integer'],
            [['inicio_preregistro', 'fin_preregistro'], 'safe'],
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
        $query = Ajuste::find();

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
            'num_semanas_semestre' => $this->num_semanas_semestre,
            'inicio_preregistro' => $this->inicio_preregistro,
            'fin_preregistro' => $this->fin_preregistro,
        ]);

        return $dataProvider;
    }
}
