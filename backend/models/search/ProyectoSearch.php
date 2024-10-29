<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Proyecto;
use yii;

/**
 * ProyectoSearch represents the model behind the search form of `common\models\Proyecto`.
 */
class ProyectoSearch extends Proyecto
{
    public $ingenieriaNombre;
    public $departamentoNombre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'departamento_id', 'ingenieria_id', 'perfil_estudiante_id', 'empresa_id', 'asesor_externo_id', 'estado_proyecto_id'], 'integer'],
            [['nombre', 'created_at', 'updated_at','ingenieriaNombre','departamentoNombre'], 'safe'],
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
        $query = Proyecto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10]
        ]);

        $dataProvider->setSort([ 
            'attributes' => [ 
                'nombre', 
                'departamentoNombre' => [
                    'asc' => ['departamento.nombre' => SORT_ASC],
                    'desc' => ['departamento.nombre' => SORT_DESC],
                    'label' => 'Departamento'], 
                'ingenieriaNombre' => [ 
                    'asc' => ['ingenieria.nombre' => SORT_ASC], 
                    'desc' => ['ingenieria.nombre' => SORT_DESC], 
                    'label' => 'Ingeniería' ], 
                'perfil_estudiante_id', ] ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'departamento_id' => $this->departamento_id,
            'ingenieria_id' => $this->ingenieria_id,
            'perfil_estudiante_id' => $this->perfil_estudiante_id,
            'empresa_id' => $this->empresa_id,
            'asesor_externo_id' => $this->asesor_externo_id,
            'estado_proyecto_id' => $this->estado_proyecto_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'proyecto.nombre', $this->nombre]);

        $query->joinWith(['departamento' => function ($q) {
            $q->andFilterWhere(['=', 'departamento.id', $this->departamentoNombre]);
            }]);

        $query->joinWith(['ingenieria' => function ($q) {
            $q->andFilterWhere(['=', 'ingenieria.id', $this->ingenieriaNombre]);
            }]);

        return $dataProvider;
    }
}
