<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ajuste".
 *
 * @property int $id
 * @property string $email_admin
 * @property int $num_semanas_semestre
 * @property string $inicio_preregistro
 * @property string $fin_preregistro
 */
class Ajuste extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ajuste';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num_semanas_semestre', 'inicio_preregistro', 'fin_preregistro', 'email_admin'], 'required'],
            [['num_semanas_semestre'], 'integer'],
            ['email_admin', 'email'],
            [['inicio_preregistro', 'fin_preregistro'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email_admin' => 'Email para notificar nuevos usuarios',
            'num_semanas_semestre' => 'Número de Semanas del Semestre',
            'inicio_preregistro' => 'Inicio Preregistro',
            'fin_preregistro' => 'Fin Preregistro',
        ];
    }
}
