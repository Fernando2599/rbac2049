<?php

namespace common\models;
use yii\helpers\ArrayHelper;
use common\models\GradoAcademico;
use common\models\Genero;
use common\models\Ingenieria;


use Yii;

/**
 * This is the model class for table "asesor_interno".
 *
 * @property int $id
 * @property string $nombre
 * @property int $ingenieria_id
 * @property int $grado_academico_id
 * @property int $genero_id
 * @property int $capacitacion
 *
 * @property Ingenieria $ingenieria
 * @property GradoAcademico $gradoAcademico
 * @property Genero $genero
 * @property Proyecto[] $proyectos
 */
class AsesorInterno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asesor_interno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'ingenieria_id', 'grado_academico_id', 'genero_id'], 'required'],
            [['ingenieria_id', 'grado_academico_id', 'genero_id', 'capacitacion'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['ingenieria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingenieria::class, 'targetAttribute' => ['ingenieria_id' => 'id']],
            [['genero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::class, 'targetAttribute' => ['genero_id' => 'id']],
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
            'grado_academico_id' => 'Grado Academico',
            'genero_id' => 'Genero',
            'capacitacion' => 'Seleccione si recibio algun tipo de capacitacion',
            'ingenieria_id' => 'Ingenieria',
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
        return $this->hasOne(Proyecto::class, ['id' => 'asesor_interno_id']);
    }

    /**
     * Gets query for [[grado_academico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGradoAcademico()
    {
        return $this->hasOne(GradoAcademico::class, ['id' => 'grado_academico_id']);
    }

    /**
     * Gets query for [[grado_academico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Genero::class, ['id' => 'genero_id']);
    }

    public function getIngenieriasList()
    {
        $ingenierias = Ingenieria::find()->all();

        $ingenieriasList = ArrayHelper::map($ingenierias, 'id', 'nombre');

        return $ingenieriasList;
    }

    public function getIngenieriaNombre() 
    { 
        return $this->ingenieria->nombre; 
    
    }
    public function getGradoNombre() 
    { 
        return $this->gradoAcademico->nombre; 
    
    }
    
}
