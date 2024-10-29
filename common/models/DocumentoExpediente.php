<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "documento_expediente".
 *
 * @property int $documento_id
 * @property int $expediente_id
 * @property string $ruta
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $comentario
 *
 * @property Documento $documento
 * @property Expediente $expediente
 */
class DocumentoExpediente extends \yii\db\ActiveRecord
{
    public $archivo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documento_expediente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['documento_id', 'expediente_id','archivo'], 'required'],
            [['documento_id', 'expediente_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['comentario'], 'string'],
            [['ruta'], 'string', 'max' => 2500],
            [['archivo'], 'file', 'extensions' => 'pdf', 'maxFiles' => '1'],
            [['documento_id', 'expediente_id'], 'unique', 'targetAttribute' => ['documento_id', 'expediente_id']],
            [['documento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documento::class, 'targetAttribute' => ['documento_id' => 'id']],
            [['expediente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Expediente::class, 'targetAttribute' => ['expediente_id' => 'id']],
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
            'documento_id' => 'Documento ID',
            'expediente_id' => 'Expediente ID',
            'archivo' => 'Archivo',
            'ruta' => 'Archivo',
            'created_at' => 'Fecha de subida',
            'updated_at' => 'Última actualización',
            'comentario' => 'Comentario',
        ];
    }

    /**
     * Gets query for [[Documento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumento()
    {
        return $this->hasOne(Documento::class, ['id' => 'documento_id']);
    }

    /**
     * Gets query for [[Expediente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpediente()
    {
        return $this->hasOne(Expediente::class, ['id' => 'expediente_id']);
    }
}
