<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ingenieria".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Especialidad[] $especialidads
 * @property PerfilEstudiante[] $perfilEstudiantes
 * @property PlanEstudios[] $planEstudios
 * @property Preregistro[] $preregistros
 * @property Proyecto[] $proyectos
 */
class Ingenieria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingenieria';
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
            'nombre' => 'Ingeniería',
        ];
    }

    /**
     * Gets query for [[Especialidads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecialidads()
    {
        return $this->hasMany(Especialidad::class, ['ingenieria_id' => 'id']);
    }

    /**
     * Gets query for [[PerfilEstudiantes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerfilEstudiantes()
    {
        return $this->hasMany(PerfilEstudiante::class, ['ingenieria_id' => 'id']);
    }

    /**
     * Gets query for [[PlanEstudios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanEstudios()
    {
        return $this->hasMany(PlanEstudios::class, ['ingenieria_id' => 'id']);
    }

    /**
     * Gets query for [[Preregistros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreregistros()
    {
        return $this->hasMany(Preregistro::class, ['ingenieria_id' => 'id']);
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::class, ['ingenieria_id' => 'id']);
    }
}
