<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PerfilEstudiante;

/**
 * PerfilEstudianteSearch represents the model behind the search form of `common\models\PerfilEstudiante`.
 */
class PerfilEstudianteSearch extends PerfilEstudiante
{
    public $ingenieriaNombre;
    public $estadoExpedienteNombre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'ingenieria_id', 'genero_id', 'especialidad_id'], 'integer'],
            [['nombre', 'matricula', 'created_at', 'updated_at', 'ingenieriaNombre', 'estadoExpedienteNombre'], 'safe'],
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
        $query = PerfilEstudiante::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10]
        ]);

        $dataProvider->setSort([ 
            'attributes' => [ 
                'nombre', 
                'matricula', 
                'ingenieriaNombre' => [ 
                    'asc' => ['ingenieria.nombre' => SORT_ASC], 
                    'desc' => ['ingenieria.nombre' => SORT_DESC], 
                    'label' => 'Ingeniería' ],
                'estadoExpedienteNombre' => [ 
                    'asc' => ['estado_expediente.nombre' => SORT_ASC], 
                    'desc' => ['estado_expediente.nombre' => SORT_DESC], 
                    'label' => 'Estado Expediente' ], ] ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'ingenieria_id' => $this->ingenieria_id,
            'genero_id' => $this->genero_id,
            'especialidad_id' => $this->especialidad_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'perfil_estudiante.nombre', $this->nombre])
            ->andFilterWhere(['like', 'matricula', $this->matricula]);

        $query->joinWith(['ingenieria' => function ($q) {
            $q->andFilterWhere(['=', 'ingenieria.id', $this->ingenieriaNombre]);
            }]);

        $query->joinWith(['expediente' => function ($q) {
            $q->andFilterWhere(['=', 'estado_expediente.id', $this->estadoExpedienteNombre]);
            }]);

        return $dataProvider;
    }
}
