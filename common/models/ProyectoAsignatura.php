<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\Asignatura;
use Yii\web\NotFoundHttpException;
/**
 * This is the model class for table "proyecto_asignatura".
 *
 * @property int $id
 * @property int $proyecto_id
 * @property int $asignatura_id
 */
class ProyectoAsignatura extends \yii\db\ActiveRecord
{
    public $asignaturaArray;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyecto_asignatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proyecto_id', 'asignaturaArray'], 'required'],
            [['proyecto_id', 'asignatura_id'], 'integer'],
            [['asignatura_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asignatura::class, 'targetAttribute' => ['asignatura_id' => 'id']],
            [['proyecto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::class, 'targetAttribute' => ['proyecto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'proyecto_id' => 'Proyecto',
            'asignatura_id' => 'Asignatura',
            'asignaturaArray' => Yii::t('app', 'Asignaturas'),

        ];
    }

    /**
     * Gets query for [[Docente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignatura()
    {
        return $this->hasOne(Asignatura::class, ['id' => 'asignatura_id']);
    }

    public function getAsignaturaNombre()
    {
        return $this->asignatura->nombre;
    }

    /**
     * Gets query for [[Proyecto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProyecto()
    {
        return $this->hasOne(Proyecto::class, ['id' => 'proyecto_id']);
    }

    public function saveAsignaturaArray()
        {
            ProyectoAsignatura::deleteAll(['proyecto_id' => $this->proyecto_id]);
            $proyecto = $this->findProyecto($this->proyecto_id);
            $proyecto->horas_totales = 0;
            foreach ($this->asignaturaArray as $value) {
                $model = new ProyectoAsignatura();
                $model->proyecto_id = $this->proyecto_id;
                $model->asignatura_id = $value;
                $model->asignaturaArray = $this->asignaturaArray;
                $asignatura = $this->findAsignatura($value);
                $proyecto->horas_totales += $asignatura->horas_dedicadas;
                $proyecto->save();
                if (!$model->save()) {
                    $this->addErrors($model->getErrors());
                    return false;
                }
            }
            return true;
        }

    public function getArrayValue(){

        $this->asignaturaArray = array_column(Yii::$app->db->createCommand('SELECT asignatura_id  
                            FROM proyecto_asignatura
                            WHERE proyecto_id = "'.$this->proyecto_id.'" 
                            ')
                            ->queryAll(),'asignatura_id');
    }

    public function findProyecto($id)
    {
        if (($model = Proyecto::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function findAsignatura($id)
    {
        if (($model = Asignatura::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
