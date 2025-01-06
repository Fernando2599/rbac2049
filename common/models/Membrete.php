<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "membrete".
 *
 * @property int $id
 * @property string $clave
 * @property string $ruta
 */
class Membrete extends \yii\db\ActiveRecord
{
    public $archivo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'membrete';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave', 'ruta'], 'required'],
            [['clave'], 'string', 'max' => 30],
            [['ruta'], 'string', 'max' => 255],
            [['archivo'], 'file', 'extensions' => 'png, jpg, jpeg, gif']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clave' => 'Clave',
            'ruta' => 'Ruta',
        ];
    }
}
