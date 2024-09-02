<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "empresa".
 *
 * @property int $id
 * @property string $nombre
 * @property string $domicilio
 * @property string $correo
 * @property string $telefono
 *
 * @property AsesorExterno[] $asesorExternos
 * @property Proyecto[] $proyectos
 */
class Empresa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empresa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'domicilio', 'correo', 'telefono'], 'required'],
            [['nombre'], 'string', 'max' => 45],
            [['domicilio'], 'string', 'max' => 255],
            [['correo'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 15],
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
            'domicilio' => 'Domicilio',
            'correo' => 'Correo',
            'telefono' => 'Telefono',
        ];
    }

    /**
     * Gets query for [[AsesorExternos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsesorExternos()
    {
        return $this->hasMany(AsesorExterno::class, ['empresa_id' => 'id']);
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::class, ['empresa_id' => 'id']);
    }

    public static function findByNombre($nombre)
    {
        return static::findOne(['nombre' => $nombre]);
    }

}
