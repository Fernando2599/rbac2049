<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProyectoDocente;

/**
 * ProyectoDocenteSearch represents the model behind the search form of `common\models\ProyectoDocente`.
 */
class ProyectoDocenteSearch extends ProyectoDocente
{
    public $proyectoNombre;
    public $docenteNombre;
    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proyecto_id', 'docente_id'], 'integer'],
            [['docenteNombre','proyectoNombre'], 'safe'],

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
    public function search($params, $proyecto_id=null)
    {
        if ($proyecto_id) 
            $query = ProyectoDocente::find()->where(['proyecto_id' => $proyecto_id]); 
        else $query = ProyectoDocente::find();

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

        $query->innerJoin('docente','docente.id = proyecto_docente.docente_id');
        $query->innerJoin('proyecto','proyecto.id = proyecto_docente.proyecto_id');

        $dataProvider->setSort([
            'defaultOrder' => [
                'proyectoNombre' => SORT_ASC
            ],
            'attributes' => [
                'proyecto_id',
                'docente_id',
                'proyectoNombre' => [
                    'asc' => ['proyecto.nombre' => SORT_ASC],
                    'desc' => ['proyecto.nombre' => SORT_DESC],
                ], 
                'docenteNombre' => [
                    'asc' => ['docente.nombre' => SORT_ASC],
                    'desc' => ['docente.nombre' => SORT_DESC],
                ],    
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'proyecto_id' => $this->proyecto_id,
            'docente_id' => $this->docente_id,
        ]);

        $query->andFilterWhere([
            'proyecto_docente.id' => $this->id,
            'proyecto_docente.proyecto_id' => $this->proyecto_id,
            'proyecto_docente.docente_id' => $this->docente_id,
        ]);  


        $query->andFilterWhere([
            'LIKE','proyecto.nombre', $this->proyectoNombre,
            ]); 
        $query->andFilterWhere([
            'LIKE','docente.nombre', $this->docenteNombre,
            ]);



        

        return $dataProvider;
    }
}
