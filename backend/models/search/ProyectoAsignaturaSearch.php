<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProyectoAsignatura;

/**
 * ProyectoAsignaturaSearch represents the model behind the search form of `common\models\ProyectoAsignatura`.
 */
class ProyectoAsignaturaSearch extends ProyectoAsignatura
{
    public $proyectoNombre;
    public $asignaturaNombre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proyecto_id', 'asignatura_id'], 'integer'],
            [['proyectoNombre','asignaturaNombre'], 'safe'],

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
        $query = ProyectoAsignatura::find();

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
        $query->innerJoin('proyecto','proyecto.id = proyecto_asignatura.proyecto_id');
        $query->innerJoin('asignatura','asignatura.id = proyecto_asignatura.asignatura_id');

        $dataProvider->setSort([
            'defaultOrder' => [
                'proyectoNombre' => SORT_ASC
            ],
            'attributes' => [
                'proyecto_id',
                'asignatura_id',
                'proyectoNombre' => [
                    'asc' => ['proyecto.nombre' => SORT_ASC],
                    'desc' => ['proyecto.nombre' => SORT_DESC],
                ], 
                'asignaturaNombre' => [
                    'asc' => ['asignatura.nombre' => SORT_ASC],
                    'desc' => ['asignatura.nombre' => SORT_DESC],
                ],    
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'proyecto_id' => $this->proyecto_id,
            'asignatura_id' => $this->asignatura_id,
        ]);

        $query->andFilterWhere([
            'proyecto_asignatura.id' => $this->id,
            'proyecto_asignatura.proyecto_id' => $this->proyecto_id,
            'proyecto_asignatura.asignatura_id' => $this->asignatura_id,
        ]);  


        $query->andFilterWhere([
            'LIKE','proyecto.nombre', $this->proyectoNombre,
            ]); 
        $query->andFilterWhere([
            'LIKE','asignatura.nombre', $this->asignaturaNombre,
            ]);

        return $dataProvider;
    }
}
