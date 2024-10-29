<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "estado_registro".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Preregistro[] $preregistros
 */
class EstadoRegistro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado_registro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[Preregistros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreregistros()
    {
        return $this->hasMany(Preregistro::class, ['estado_registro_id' => 'id']);
    }
}
