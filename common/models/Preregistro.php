<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "preregistro".
 *
 * @property int $id
 * @property string $nombre
 * @property string $matricula
 * @property string $email
 * @property int $ingenieria_id
 * @property string $kardex
 * @property string $constancia_ingles
 * @property string $cv
 * @property string $constancia_creditos_complementarios
 * @property string $created_at
 * @property string $updated_at
 * @property int $estado_registro_id
 * @property string|null $comentario
 *
 * @property EstadoRegistro $estadoRegistro
 * @property Ingenieria $ingenieria
 */
class Preregistro extends \yii\db\ActiveRecord
{
    public $archivoKardex, $archivoConstancia_ingles, $archivoCv, $archivoConstancia_creditos_complementarios, $terminos_condiciones;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preregistro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'matricula', 'email', 'ingenieria_id'], 'required'],
            ['terminos_condiciones', 'required', 'on' => ['register']],
            [['ingenieria_id', 'estado_registro_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['comentario'], 'string'],
            [['nombre', 'matricula', 'email'], 'string', 'max' => 45],
            ['email', 'email'],
            //[['kardex', 'constancia_ingles', 'constancia_servicio_social', 'constancia_creditos_complementarios'], 'string', 'max' => 2500],
            [['archivoKardex', 'archivoConstancia_ingles', 'archivoCv', 'archivoConstancia_creditos_complementarios'], 'file', 'extensions' => 'pdf', 'maxFiles' => '1'],
            //[['email'], 'unique'],
            ['email', 'unique', 'targetClass' => '\common\models\Preregistro', 'message' => 'Este correo electronico ya esta en uso.'],
            //[['matricula'], 'unique'],
            ['matricula', 'unique', 'targetClass' => '\common\models\Preregistro', 'message' => 'Esta matrícula ya ha sido pre-registrada'],
            [['estado_registro_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoRegistro::class, 'targetAttribute' => ['estado_registro_id' => 'id']],
            [['ingenieria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingenieria::class, 'targetAttribute' => ['ingenieria_id' => 'id']],
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
            'matricula' => 'Matricula',
            'email' => 'Email',
            'ingenieria_id' => 'Ingenieria',
            'archivoKardex' => 'Kardex',
            'archivoConstancia_ingles' => 'Constancia de Ingles',
            'constancia_ingles' => 'Constancia de Inglés',
            'archivoCv' => 'Curriculum',
            'cv' => 'Curriculum',
            'archivoConstancia_creditos_complementarios' => 'Constancia de Creditos Complementarios',
            'constancia_creditos_complementarios' => 'Constancia de Creditos Complementarios',
            'created_at' => 'Fecha de creación',
            'updated_at' => 'Última actualización',
            'estado_registro_id' => 'Estado',
            'comentario' => 'Comentario',
            'terminos_condiciones' => 
            'He sido informado que deberé cumplir con los requisitos establecidos en el Modelo de Educación Dual del TecNM, el Convenio de Colaboración y las actividades del Proyecto Integral de Educación Dual que se determine con el objetivo de poder acreditar las asignaturas faltantes de mi plan de estudios.
            
            De igual forma deberé sujetarme a los lineamientos académico administrativos del ITSVA así como a las normas y políticas de operación de la propia empresa o institución donde realizaré las actividades de este programa. 
            
            Reconozco que el desempeño de mis actividades relacionadas con el Programa de Educación Dual queda bajo mi exclusiva responsabilidad, sin responsabilizar al Instituto Tecnológico Superior de Valladolid.
            Estoy consciente que esta solicitud es el inicio del proceso de postulación y dependerá del cumplimiento de entrega de los documentos en tiempo y forma de mi parte, así también de la aceptación de parte de la empresa a la que me postule para que pueda considerarme un alumno dual.',

        ];
    }

    /**
     * Gets query for [[EstadoRegistro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoRegistro()
    {
        return $this->hasOne(EstadoRegistro::class, ['id' => 'estado_registro_id']);
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


    public function getEstadoRegistroNombreList()
    {
        $estadoRegistro = EstadoRegistro::find()->all();

        $estadoRegistroNombreList = ArrayHelper::map($estadoRegistro, 'id', 'nombre');

        return $estadoRegistroNombreList;
    }

    public function getEstadoRegistroNombre() 
    { 
        return $this->estadoRegistro->nombre; 
    }

    public static function findByMatricula($matricula)
    {
        return static::findOne(['matricula' => $matricula]);
    }
}
