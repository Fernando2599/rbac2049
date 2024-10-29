<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DocumentoExpediente;

/**
 * DocumentoExpedienteSearch represents the model behind the search form of `common\models\DocumentoExpediente`.
 */
class DocumentoExpedienteSearch extends DocumentoExpediente
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documento_id', 'expediente_id'], 'integer'],
            [['ruta', 'created_at', 'updated_at', 'comentario'], 'safe'],
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
    public function search($params, $expediente_id=null)
    {
        if ($expediente_id)
            $query = DocumentoExpediente::find()->where(['expediente_id' => $expediente_id]);
        else
            $query = DocumentoExpediente::find();

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
            'documento_id' => $this->documento_id,
            'expediente_id' => $this->expediente_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'ruta', $this->ruta])
            ->andFilterWhere(['like', 'comentario', $this->comentario]);

        return $dataProvider;
    }
}
