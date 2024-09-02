<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "grado_academico".
 *
 * @property int $id
 * @property string $nombre
 * @property int $estado
 */
class GradoAcademico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grado_academico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['estado'], 'integer'],
            [['nombre'], 'string', 'max' => 20],
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
            'estado' => 'Estado',
        ];
    }
}
