<?php

namespace backend\models;

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
}
