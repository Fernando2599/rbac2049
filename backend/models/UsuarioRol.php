<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "usuario_rol".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rol_id
 */
class UsuarioRol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario_rol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'rol_id'], 'required'],
            [['user_id', 'rol_id'], 'integer'],
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
            'rol_id' => 'Rol ID',
        ];
    }
}
