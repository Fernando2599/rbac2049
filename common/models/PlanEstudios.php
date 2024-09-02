<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plan_estudios".
 *
 * @property int $id
 * @property string $nombre
 * @property int $ingenieria_id
 *
 * @property Ingenieria $ingenieria
 * @property Proyecto[] $proyectos
 * @property Semestre[] $semestres
 */
class PlanEstudios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_estudios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'ingenieria_id'], 'required'],
            [['ingenieria_id'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['ingenieria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingenieria::class, 'targetAttribute' => ['ingenieria_id' => 'id']],
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
            'ingenieria_id' => 'Ingenieria ID',
        ];
    }

    /**
     * Gets query for [[Ingenieria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIngenieria()
    {
        return $this->hasOne(Ingenieria::class, ['id' => 'ingenieria_id']);
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::class, ['plan_estudios_id' => 'id']);
    }

    /**
     * Gets query for [[Semestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemestres()
    {
        return $this->hasMany(Semestre::class, ['plan_estudios_id' => 'id']);
    }

    public static function findByNombre($nombre)
    {
        return static::findOne(['nombre' => $nombre]);
    }
}
