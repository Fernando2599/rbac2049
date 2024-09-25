<?php

namespace backend\models\search;
use yii\web\NotFoundHttpException;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Preregistro;
use common\models\ValorHelpers;
use common\models\PermisosHelpers;
use common\models\User;
use backend\models\UsuarioPermiso;

use Yii;
/**
 * PreregistroSearch represents the model behind the search form of `common\models\Preregistro`.
 */
class PreregistroSearch extends Preregistro
{
    public $ingenieriaNombre;
    public $estadoRegistroNombre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ingenieria_id', 'estado_registro_id'], 'integer'],
            [['nombre', 'matricula', 'email', 'kardex', 'constancia_ingles', 'cv', 'constancia_creditos_complementarios', 'created_at', 'updated_at', 'comentario', 'ingenieriaNombre','estadoRegistroNombre'], 'safe'],
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
        $query = Preregistro::find();

        // add conditions that should always apply here

         // Agregar condiciones que siempre deben aplicarse aquí

    $id_user = Yii::$app->user->identity->getId();
    if ($id_user !== null) {
        // Buscar al usuario
        $user = UsuarioPermiso::findOne(['user_id' => $id_user]);
        
        // Verificar si el usuario y su permiso están definidos
        if ($user !== null && $user->permiso !== null) {
            $nombrePermiso = $user->permiso->permiso_nombre;

            //Filtrar por Permisos de coordinador

            $permisosCoordinadores = [
                'CoordinadorSistemas', 
                'CoordinadorAdministracion', 
                'CoordinadorCivil', 
                'CoordinadorAmbiental', 
                'CoordinadorIndustrial', 
                'CoordinadorGestionEmpresarial'
            ];
            $permisosAvanzados = [
                'AdministradorDelSistema', 
                'SuperUsuario'
            ];

            // Si el usuario tiene permiso de coordinador, aplicar el filtro por ingeniería
            if (in_array($nombrePermiso, $permisosCoordinadores)) {
                $userPermisoValor = ValorHelpers::getPermisoValor($nombrePermiso);
                $query->andFilterWhere(['=', 'ingenieria_id', $userPermisoValor]);
            } 
            // Si el usuario tiene un permiso avanzado, no se aplica ningún filtro
            elseif (in_array($nombrePermiso, $permisosAvanzados)) {
                // No aplicar filtros, el usuario avanzado ve todo
            } 
            // Si no tiene permisos ni de coordinador ni avanzados, lanzar excepción
            else {
                throw new NotFoundHttpException('Necesitas otro tipo de permiso para esta acción.');
            }
        } else {
            throw new NotFoundHttpException('El usuario no tiene un permiso asignado.');
        }
    } else {
        throw new NotFoundHttpException('Necesitas permisos para esta acción.');
    }



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10]
        ]);

        $dataProvider->setSort([ 
            'attributes' => [ 
                'nombre', 
                'matricula', 
                'email', 
                'ingenieriaNombre' => [ 
                    'asc' => ['ingenieria.nombre' => SORT_ASC], 
                    'desc' => ['ingenieria.nombre' => SORT_DESC], 
                    'label' => 'Ingeniería' ], 
                'estadoRegistroNombre' => [ 
                    'asc' => ['estado_registro.nombre' => SORT_ASC], 
                    'desc' => ['estado_registro.nombre' => SORT_DESC], 
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'estado_registro_id' => $this->estado_registro_id,
        ]);

        $query->andFilterWhere(['like', 'preregistro.nombre', $this->nombre])
            ->andFilterWhere(['like', 'matricula', $this->matricula])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'kardex', $this->kardex])
            ->andFilterWhere(['like', 'constancia_ingles', $this->constancia_ingles])
            ->andFilterWhere(['like', 'cv', $this->cv])
            ->andFilterWhere(['like', 'constancia_creditos_complementarios', $this->constancia_creditos_complementarios])
            ->andFilterWhere(['like', 'comentario', $this->comentario]);
        
        $query->joinWith(['ingenieria' => function ($q) {
            $q->andFilterWhere(['=', 'ingenieria.id', $this->ingenieriaNombre]);
            }]);

        $query->joinWith(['estadoRegistro' => function ($q) {
            $q->andFilterWhere(['=', 'estado_registro.id', $this->estadoRegistroNombre]);
            }]);

        return $dataProvider;
    }
}
