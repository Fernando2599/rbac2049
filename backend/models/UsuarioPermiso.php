<?php

namespace backend\models;
use  backend\models\Permiso;
use Yii;

/**
 * This is the model class for table "usuario_permiso".
 *
 * @property int $id
 * @property int $user_id
 * @property int $permiso_id
 */
class UsuarioPermiso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario_permiso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'permiso_id'], 'required'],
            [['user_id', 'permiso_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'permiso_id' => 'Permiso ID',
        ];
    }

    /**
     * relación get permiso
     *
     */
    public function getPermiso()
    {
        return $this->hasOne(Permiso::className(), ['id' => 'permiso_id']);
    }
    /**
     * get rol nombre
     *
     */
    public function getPermisoNombre()
    {
        return $this->permiso ? $this->permiso->permiso_nombre : 'Sin permiso';
    }
    /**
     * get lista de roles para lista desplegable
     */
    public static function getPermisoLista()
    {
        $dropciones = Permiso::find()->asArray()->all();
        return ArrayHelper::map($dropciones, 'id', 'permiso_nombre');
    }
}
