<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Documento;

/**
 * DocumentoSearch represents the model behind the search form of `common\models\Documento`.
 */
class DocumentoSearch extends Documento
{
    public $estadoDocumentoNombre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'descripcion', 'fecha_inicio', 'fecha_cierre', 'created_at', 'updated_at', 'estadoDocumentoNombre'], 'safe'],
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
        $query = Documento::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10]
        ]);

        $dataProvider->setSort([ 
            'attributes' => [ 
                'nombre', 
                'fecha_inicio', 
                'fecha_cierre', 
                'estadoDocumentoNombre' => [ 
                    'asc' => ['estado_documento.nombre' => SORT_ASC], 
                    'desc' => ['estado_documento.nombre' => SORT_DESC], 
                    'label' => 'Estado' ], ] ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_cierre' => $this->fecha_cierre,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'documento.nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
