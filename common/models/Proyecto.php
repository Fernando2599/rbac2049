<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use common\models\Departamento;
use common\models\Ingenieria;
use common\models\EstadoProyecto;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "proyecto".
 *
 * @property int $id
 * @property string $nombre
 * @property int $plan_estudios_id
 * @property int $departamento_id
 * @property int $asesor_interno_id
 * @property int $ingenieria_id
 * @property int $perfil_estudiante_id
 * @property int $empresa_id
 * @property int $asesor_externo_id
 * @property int $periodo_id
 * @property int $horas_totales
 * @property int $estado_proyecto_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $descripcion
 * @property int $semestre_id
 * 
 *
 * @property AsesorExterno $asesorExterno
 * @property AsesorInterno $asesorInterno
 * @property Departamento $departamento
 * @property Empresa $empresa
 * @property EstadoProyecto $estadoProyecto
 * @property Ingenieria $ingenieria
 * @property PerfilEstudiante $perfilEstudiante
 * @property PlanEstudios $planEstudios 
 * @property Periodo $periodo
 * @property Semestre $semestre
 * @property ProyectoDocente[] $proyectoDocentes
 */
class Proyecto extends \yii\db\ActiveRecord
{
    public $nombreEstudiante;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyecto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'plan_estudios_id', 'departamento_id', 'asesor_interno_id', 'ingenieria_id', 'perfil_estudiante_id', 'empresa_id', 'asesor_externo_id', 'periodo_id', 'estado_proyecto_id', 'semestre_id'], 'required'],
            [['departamento_id', 'plan_estudios_id', 'asesor_interno_id', 'periodo_id', 'ingenieria_id', 'perfil_estudiante_id', 'empresa_id', 'asesor_externo_id', 'estado_proyecto_id', 'semestre_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 2500],
            ['nombre', 'unique', 'targetClass' => '\common\models\Proyecto', 'message' => Yii::t('app', 'Proyecto ya creado, intente con otro nombre')],
            ['perfil_estudiante_id', 'unique', 'targetClass' => '\common\models\Proyecto', 'message' => 'Este alumno ya tiene asignado un proyecto.'],
            [['plan_estudios_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanEstudios::class, 'targetAttribute' => ['plan_estudios_id' => 'id']],
            [['asesor_interno_id'], 'exist', 'skipOnError' => true, 'targetClass' => AsesorInterno::class, 'targetAttribute' => ['asesor_interno_id' => 'id']],
            [['periodo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Periodo::class, 'targetAttribute' => ['periodo_id' => 'id']],
            [['asesor_externo_id'], 'exist', 'skipOnError' => true, 'targetClass' => AsesorExterno::class, 'targetAttribute' => ['asesor_externo_id' => 'id']],
            [['departamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::class, 'targetAttribute' => ['departamento_id' => 'id']],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['estado_proyecto_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoProyecto::class, 'targetAttribute' => ['estado_proyecto_id' => 'id']],
            [['ingenieria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingenieria::class, 'targetAttribute' => ['ingenieria_id' => 'id']],
            [['perfil_estudiante_id'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilEstudiante::class, 'targetAttribute' => ['perfil_estudiante_id' => 'id']],

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
            'nombre' => Yii::t('app','Nombre'),
            'plan_estudios_id' => Yii::t('app','Plan de Estudios'),
            'semestre_id' => 'Semestre',
            'departamento_id' => 'Departamento',
            'asesor_interno_id' => 'Asesor Interno',
            'ingenieria_id' => 'Ingeniería',
            'perfil_estudiante_id' => Yii::t('app','Estudiante'),
            'empresa_id' => 'Empresa',
            'asesor_externo_id' => 'Asesor Externo',
            'periodo_id' => 'Periodo',
            'horas_totales' => 'Horas Totales',
            'estado_proyecto_id' => 'Estado del Proyecto',
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Ultima actualización',
            'descripcion' => 'Descripción',
        ];
    }


    /**
     * Gets query for [[AsesorExterno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsesorInterno()
    {
        return $this->hasOne(AsesorInterno::class, ['id' => 'asesor_interno_id']);
    }

    public function getAsesorInternoList()
    {
        $asesorInterno = AsesorInterno::find()->all();

        $asesorInternoList = ArrayHelper::map($asesorInterno, 'id', 'nombre');

        return $asesorInternoList;
    }

    public function getAsesorInternoNombre()
    {
        return $this->asesorInterno->nombre;
    }

    /**
     * Gets query for [[AsesorExterno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsesorExterno()
    {
        return $this->hasOne(AsesorExterno::class, ['id' => 'asesor_externo_id']);
    }

    /**
     * Gets query for [[Departamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamento::class, ['id' => 'departamento_id']);
    }

    public function getDepartamentoList()
    {
        $departamento = Departamento::find()->all();

        $departamentoList = ArrayHelper::map($departamento, 'id', 'nombre');

        return $departamentoList;
    }

    public function getDepartamentoNombre()
    {
        return $this->departamento->nombre;
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
     * Gets query for [[EstadoProyecto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoProyecto()
    {
        return $this->hasOne(EstadoProyecto::class, ['id' => 'estado_proyecto_id']);
    }

    public function getEstadoProyectosList()
    {
        $estadoProyectos = EstadoProyecto::find()->all();

        $estadoProyectosList = ArrayHelper::map($estadoProyectos, 'id', 'nombre');

        return $estadoProyectosList;
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

    /**
     * Gets query for [[PerfilEstudiante]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerfilEstudiante()
    {
        return $this->hasOne(PerfilEstudiante::class, ['id' => 'perfil_estudiante_id']);
    }

    public function getMatriculasList()
    {
        $matriculas = PerfilEstudiante::find()->all();

        $matriculasList = ArrayHelper::map($matriculas, 'id', 'matricula');

        return $matriculasList;
    }

    public function getMatriculaEstudiante()
    {
        return $this->perfilEstudiante->matricula;
    }
    /**
     * Gets query for [[PerfilEstudiante]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanEstudios()
    {
        return $this->hasOne(PlanEstudios::class, ['id' => 'plan_estudios_id']);
    }

    public function getPlanEstudiosList()
    {
        $estudios = PlanEstudios::find()->all();

        $estudiosList = ArrayHelper::map($estudios, 'id', 'nombre');

        return $estudiosList;
    }

    public function getPlanEstudiosNombre()
    {
        return $this->planEstudios->nombre;
    }

    /**
     * Gets query for [[PerfilEstudiante]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodo()
    {
        return $this->hasOne(Periodo::class, ['id' => 'periodo_id']);
    }

    public function getPeriodoList()
    {
        $periodo = Periodo::find()->all();

        $periodoList = ArrayHelper::map($periodo, 'id', 'nombre');

        return $periodoList;
    }

    public function getPeriodoNombre()
    {
        return $this->periodo->nombre;
    }

    /**
     * Gets query for [[Semestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemestre()
    {
        return $this->hasOne(Semestre::class, ['id' => 'semestre_id']);
    }

    public function getSemestreList()
    {
        $semestre = Semestre::find()->all();

        $semestreList = ArrayHelper::map($semestre, 'id', 'nombre');

        return $semestreList;
    }


    /**
     * Gets query for [[ProyectoDocentes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoDocentes()
    {
        return $this->hasMany(ProyectoDocente::class, ['proyecto_id' => 'id']);
    }

    public static function getEstudiantes($ingenieria_id)
    {
        $data = \common\models\PerfilEstudiante::find()
            ->where(['ingenieria_id' => $ingenieria_id])
            ->select(['id', 'nombre AS name'])->asArray()->all();

        return $data;
    }

    public static function getAsesoresInternos($ingenieria_id)
    {
        $data = \common\models\AsesorInterno::find()
            ->where(['ingenieria_id' => $ingenieria_id])
            ->select(['id', 'nombre AS name'])->asArray()->all();

        return $data;
    }

    public static function getAsesoresExternos($empresa_id)
    {
        $data = \common\models\AsesorExterno::find()
            ->where(['empresa_id' => $empresa_id])
            ->select(['id', 'nombre AS name'])->asArray()->all();

        return $data;
    }
}
