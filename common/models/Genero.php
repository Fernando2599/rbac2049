<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "genero".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property PerfilEstudiante[] $perfilEstudiantes
 */
class Genero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genero';
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
            'nombre' => 'Genero',
        ];
    }

    /**
     * Gets query for [[PerfilEstudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerfilEstudiantes()
    {
        return $this->hasMany(PerfilEstudiante::class, ['genero_id' => 'id']);
    }
}
