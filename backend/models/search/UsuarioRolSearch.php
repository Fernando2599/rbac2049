<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UsuarioRol;

/**
 * UsuarioRolSearch represents the model behind the search form of `backend\models\UsuarioRol`.
 */
class UsuarioRolSearch extends UsuarioRol
{
     // Definimos la propiedad 
     public $rolNombre;
     public $userName;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'rol_id'], 'integer'], //campos enteros
            [['rolNombre', 'userName'], 'safe'], // Campo de busqueda
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
        $query = UsuarioRol::find();

        // add conditions that should always apply here

        // Hacemos el join con la tabla Rol para poder buscar por nombre
        $query->joinWith(['rol', 'user']); // 'rol' es la relación en el modelo UsuarioRol

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
            'user_id' => $this->user_id,
            'rol_id' => $this->rol_id,
        ]);

        // Filtramos por el nombre del rol
        $query->andFilterWhere(['like', 'rol.rol_nombre', $this->rolNombre]);
        // Filtramos por el nombre de usuario
        $query->andFilterWhere(['like', 'user.username', $this->userName]);

        return $dataProvider;
    }
}
