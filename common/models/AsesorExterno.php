<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "asesor_externo".
 *
 * @property int $id
 * @property string $nombre
 * @property int $empresa_id
 *
 * @property Empresa $empresa
 * @property Proyecto[] $proyectos
 */
class AsesorExterno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asesor_externo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'empresa_id'], 'required'],
            [['empresa_id'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::class, 'targetAttribute' => ['empresa_id' => 'id']],
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
            'empresa_id' => 'Empresa',
        ];
    }

    /**
     * Gets query for [[Empresa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::class, ['id' => 'empresa_id']);
    }

    /**
     * Gets query for [[Proyectos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::class, ['asesor_externo_id' => 'id']);
    }

    public static function findByNombre($nombre)
    {
        return static::findOne(['nombre' => $nombre]);
    }

    public function getEmpresasList()
    {
        $empresas = Empresa::find()->all();

        $empresasList = ArrayHelper::map($empresas, 'id', 'nombre');

        return $empresasList;
    }

    public function getEmpresaNombre() 
    { 
        return $this->empresa->nombre; 
    }
}
