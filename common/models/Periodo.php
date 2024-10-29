<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "periodo".
 *
 * @property int $id
 * @property string $nombre
 * @property string $inicio
 * @property string $fin
 *
 * @property Proyecto[] $proyectos
 */
class Periodo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'periodo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'inicio', 'fin'], 'required'],
            [['inicio', 'fin'], 'safe'],
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
            'inicio' => 'Inicio',
            'fin' => 'Fin',
        ];
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::class, ['periodo_id' => 'id']);
    }

    public static function findByNombre($nombre)
    {
        return static::findOne(['nombre' => $nombre]);
    }
}
