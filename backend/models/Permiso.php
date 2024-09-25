<?php

namespace backend\models;

use Yii;
use  common\models\User;

/**
 * This is the model class for table "permiso".
 *
 * @property int $id
 * @property string $permiso_nombre
 * @property int $permiso_valor
 */
class Permiso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permiso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'permiso_nombre', 'permiso_valor'], 'required'],
            [['id', 'permiso_valor'], 'integer'],
            [['permiso_nombre'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'permiso_nombre' => 'Permiso Nombre',
            'permiso_valor' => 'Permiso Valor',
        ];
    }
    public  function  getUsers()
    {
    return  $this->hasMany(User::className(),  ['permiso_id'  =>  'id']);
    }
}
