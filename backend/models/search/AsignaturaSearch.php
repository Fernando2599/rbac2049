<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Asignatura;

/**
 * AsignaturaSearch represents the model behind the search form of `common\models\Asignatura`.
 */
class AsignaturaSearch extends Asignatura
{
    public $asesorInternoNombre, $semestreNombre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'asesor_interno_id', 'horas_dedicadas', 'ingenieria_id'], 'integer'],
            [['nombre', 'clave', 'creditos', 'competencia_disciplinar', 'periodo_desarrollo', 'periodo_acreditacion', 'asesorInternoNombre', 'semestreNombre'], 'safe'],
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
    public function search($params, $proyecto_id = null, $ingenieria_id = null)
    {
        if ($proyecto_id) 
        $query = Asignatura::find() ->leftJoin('proyecto_asignatura', 'proyecto_asignatura.asignatura_id = asignatura.id') ->where(['proyecto_asignatura.proyecto_id' => $proyecto_id]);
        else if ($ingenieria_id) 
        $query = Asignatura::find() ->where(['asignatura.ingenieria_id' => $ingenieria_id]);
        else 
            $query = Asignatura::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->setSort([ 
            'attributes' => [ 
                'nombre',
                'semestreNombre' => [
                    'asc' => ['semestre.nombre' => SORT_ASC],
                    'desc' => ['semestre.nombre' => SORT_DESC],
                    'label' => 'Semestre'], 
                'asesorInternoNombre' => [
                    'asc' => ['asesor_interno.nombre' => SORT_ASC],
                    'desc' => ['asesor_interno.nombre' => SORT_DESC],
                    'label' => 'Docente'], ] ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'asesor_interno_id' => $this->asesor_interno_id,
            'horas_dedicadas' => $this->horas_dedicadas,
            'ingenieria_id' => $this->ingenieria_id,
        ]);

        $query->andFilterWhere(['like', 'asignatura.nombre', $this->nombre])
            ->andFilterWhere(['like', 'clave', $this->clave])
            ->andFilterWhere(['like', 'creditos', $this->creditos])
            ->andFilterWhere(['like', 'competencia_disciplinar', $this->competencia_disciplinar])
            ->andFilterWhere(['like', 'periodo_desarrollo', $this->periodo_desarrollo])
            ->andFilterWhere(['like', 'periodo_acreditacion', $this->periodo_acreditacion]);

        $query->joinWith(['asesorInterno' => function ($q) {
            $q->andFilterWhere(['=', 'asesor_interno.id', $this->asesorInternoNombre]);
            }]);

        $query->joinWith(['semestre' => function ($q) {
            $q->andFilterWhere(['=', 'semestre.id', $this->semestreNombre]);
            }]);

        return $dataProvider;
    }
}
