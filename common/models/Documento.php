<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "documento".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string $fecha_inicio
 * @property string $fecha_cierre
 * @property string $created_at
 * @property string $updated_at
 *
 * @property DocumentoExpediente[] $documentoExpedientes
 * @property Expediente[] $expedientes
 */
class Documento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'fecha_inicio', 'fecha_cierre'], 'required'],
            [['descripcion'], 'string'],
            [['fecha_inicio', 'fecha_cierre', 'created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
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
            'descripcion' => 'Descripcion',
            'fecha_inicio' => 'Fecha de Inicio',
            'fecha_cierre' => 'Fecha de Cierre',
            'created_at' => 'Fecha de creación',
            'updated_at' => 'Última Actualización',
        ];
    }

    /**
     * Gets query for [[DocumentoExpedientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentoExpedientes()
    {
        return $this->hasMany(DocumentoExpediente::class, ['documento_id' => 'id']);
    }

    /**
     * Gets query for [[Expedientes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpedientes()
    {
        return $this->hasMany(Expediente::class, ['id' => 'expediente_id'])->viaTable('documento_expediente', ['documento_id' => 'id']);
    }
}
