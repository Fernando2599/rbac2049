<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use common\models\Expediente;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * This is the model class for table "perfil_estudiante".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $nombre
 * @property string|null $matricula
 * @property int|null $ingenieria_id
 * @property int|null $genero_id
 * @property int|null $especialidad_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Especialidad $especialidad
 * @property Genero $genero
 * @property Ingenieria $ingenieria
 * @property Proyecto[] $proyectos
 */
class PerfilEstudiante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfil_estudiante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre','matricula','ingenieria_id'], 'required'],
            [['user_id', 'ingenieria_id', 'genero_id', 'especialidad_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre', 'matricula'], 'string', 'max' => 45],
            [['especialidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidad::class, 'targetAttribute' => ['especialidad_id' => 'id']],
            [['genero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::class, 'targetAttribute' => ['genero_id' => 'id']],
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
            'user_id' => 'User ID',
            'nombre' => 'Nombre',
            'matricula' => 'Matricula',
            'ingenieria_id' => 'Ingeniería',
            'genero_id' => 'Genero',
            'especialidad_id' => 'Especialidad',
            'created_at' => 'Fecha de creación',
            'updated_at' => 'Ultima Actualización',
            'expedienteLink' => Yii::t('app', 'Expediente'),
            'expedienteId' => Yii::t('app', 'Expediente'),
            'expedienteIdLink' => Yii::t('app', 'Expediente'),
            'estadoExpedienteLink' => Yii::t('app', 'Estado Expediente'),
        ];
    }

    /**
     * Gets query for [[Especialidad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecialidad()
    {
        return $this->hasOne(Especialidad::class, ['id' => 'especialidad_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getExpediente()
    {
    return $this->hasOne(Expediente::className(), ['perfil_estudiante_id' => 'id']);
    }

    /**
     * Gets query for [[Genero]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Genero::class, ['id' => 'genero_id']);
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
        return $this->hasMany(Proyecto::class, ['perfil_estudiante_id' => 'id']);
    }

    public static function findByNombre($nombre)
    {
        return static::findOne(['nombre' => $nombre]);
    }

    public static function getGeneroLista()
    {
        $droptions = Genero::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'nombre');
    }

    public static function getEspecialidadLista()
    {
        $droptions = Especialidad::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'nombre');
    }

    public static function getIngenieriaLista()
    {
        $droptions = Ingenieria::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'nombre');
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

    public function getExpedienteId()
    {
        return $this->expediente ? $this->expediente->id : 'ninguno';
    }

    public function getExpedienteLink()
    {
        $url = Url::to(['expediente/view', 'id'=>$this->expedienteId]);
        $opciones = [];
        return Html::a($this->expediente ? 'Expediente' : 'Sin expediente', $url, $opciones);
    }

    public function getEstadoExpediente()
    {
        return $this->expediente->estado_expediente_id;
    }

    public function getEstadoExpedienteLink()
    {
        $url = Url::to(['expediente/view', 'id'=>$this->ExpedienteId]);
        $opciones = [];
        return $this->getEstadoNombre($this->getEstadoExpediente());
    }

    public static function getEstadoNombre($estado_expediente_id)
    {
        $estado = EstadoExpediente::find('nombre')
            ->where(['id' => $estado_expediente_id])
            ->one();
        return isset($estado->nombre) ? $estado->nombre : false;
    }

    public function getEstadoExpedienteList()
    {
        $estadosExpedientes = EstadoExpediente::find()->all();

        $estadosExpedientesList = ArrayHelper::map($estadosExpedientes, 'id', 'nombre');

        return $estadosExpedientesList;
    }

    public static function getEspecialidades($ingenieria_id) {
        $data=\common\models\Especialidad::find()
        ->where(['ingenieria_id'=>$ingenieria_id])
        ->select(['id','nombre AS name'])->asArray()->all();

        return $data;
    }
}
