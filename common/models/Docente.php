<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "docente".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property DocenteAsignatura[] $docenteAsignaturas
 * @property ProyectoDocente[] $proyectoDocentes
 */
class Docente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'docente';
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
     * Gets query for [[DocenteAsignaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocenteAsignaturas()
    {
        return $this->hasMany(DocenteAsignatura::class, ['docente_id' => 'id']);
    }

    /**
     * Gets query for [[ProyectoDocentes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoDocentes()
    {
        return $this->hasMany(ProyectoDocente::class, ['docente_id' => 'id']);
    }
}
