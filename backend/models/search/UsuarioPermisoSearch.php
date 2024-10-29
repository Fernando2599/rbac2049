<?php
namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UsuarioPermiso;

class UsuarioPermisoSearch extends UsuarioPermiso
{
    // Definimos la propiedad 
    public $permisoNombre;
    public $userName;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'permiso_id'], 'integer'], // Los campos que son enteros
            [['permisoNombre', 'userName'], 'safe'], // Campo de busqueda
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
        $query = UsuarioPermiso::find();

        // Hacemos el join con la tabla Permiso para poder buscar por nombre de permiso
        $query->joinWith(['permiso', 'user']); // 'permiso' es la relación en el modelo UsuarioPermiso

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'permiso_id' => $this->permiso_id,
        ]);

        // Filtramos por el nombre del permiso
        $query->andFilterWhere(['like', 'permiso.permiso_nombre', $this->permisoNombre]);
        // Filtramos por el nombre de usuario
        $query->andFilterWhere(['like', 'user.username', $this->userName]);

        return $dataProvider;
    }
}

