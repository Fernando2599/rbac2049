<?php
namespace common\models;
use common\models\Proyecto;
use common\models\Docente;
use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;
class ProyectoForm extends Model
{
    private $_proyecto; //Atributo donde se guardara el proyecto
    private $_docentes; //Atributo donde se guardará la lista de los docentes

    public function rules()
    {
        return [
            [['Proyecto'], 'required'],
            [['Docentes'], 'safe'],
        ];
    }

    public function save()
    {
      //Validar proyecto
        if(!$this->proyecto->validate()) {
            return false;
        }
        //Iniciar transacción
        $transaction = Yii::$app->db->beginTransaction();
        //Guardar proyecto
        if (!$this->proyecto->save()) {
            $transaction->rollBack();
            return false;
        }
        //Guardar lista de docentes
        if (!$this->saveDocentes()) {
            $transaction->rollBack();
            return false;
        }
        //Finalizar transacción
        $transaction->commit();
        return true;
    }

    public function saveDocentes()
    {
        //Arreglo con los docentes que ya estan en la db y deben mantenerse
        //Al actualizar el proyecto actualiza los docentes que han sido modificado y elimina aquellos que han sido removidos
        $mantener = [];
        //Recorrer los docentes
        foreach ($this->docentes as $docente) {
            //Asignar el id del proyecto
            $docente->proyectoId = $this->proyecto->proyectoId;
            //Guardar producto
            if (!$docente->save()) {
            return false;
            }
            //Agregar id del docente a lista
            $mantener[] = $docente->docenteId;
        }
        //Buscar todos los docentes asociados al proyecto
        $query = Docente::find()->andWhere(['proyectoId' => $this->proyecto->proyectoId]);
        if ($mantener) {
            //Filtrar por los docentes que no estan en la lista de mantener
            $query->andWhere(['not in', 'docenteId', $mantener]);
        }
        //Eliminar los docentes que no estan en la lista
        foreach ($query->all() as $docente) {
            $docente->delete();
        }
        return true;
    }
    
    public function delete()
    {
        //Iniciar transacción
        $transaction = Yii::$app->db->beginTransaction();
        //Eliminar docentes
        if (!$this->deleteDocentes()) {
            $transaction->rollBack();
            return false;
        }
        //Eliminar proyecto
        if (!$this->proyecto->delete()) {
            $transaction->rollBack();
            return false;
        }
        //Finalizar transacción
        $transaction->commit();
        return true;
    }

    public function deleteDocentes()
    {
        //Recoorrer los docentes
        foreach ($this->docentes as $docente) {
          //Eliminar docente
            if (!$docente->delete()) {
                return false;
            }
        }
        return true;
    }

    public function getProyecto()
    {
        return $this->_proyecto;
    }

    public function setProyecto($proyecto)
    {
        if ($proyecto instanceof Proyecto) {
            $this->_proyecto = $proyecto;
        } else if (is_array($proyecto)) {
            $this->_proyecto->setAttributes($proyecto);
        }
    }

    public function getDocentes()
    {
        if ($this->_docentes=== null) {
            $this->_docentes = $this->proyecto->isNewRecord ? [] : $this->proyecto->docentes;
        }
        return $this->_docentes;
    }

    private function getDocente($key)
    {
        $docente = $key && strpos($key, 'nuevo') === false ? Docente::findOne($key) : false;
        if (!$docente) {
            $docente = new Docente();
            $docente->loadDefaultValues();
        }
        return $docente;
    }

    public function setDocentes($docentes)
    {
        unset($docentes['__id__']); // Elimina el docente vacío usado para crear formularios
        $this->_docentes = [];
        //Recorrer docentes
        foreach ($docentes as $key => $docente) {
          //Obtiene producto por clave y lo agrega al atributo docentes
            if (is_array($docente)) {
                $this->_docentes[$key] = $this->getDocente($key);
                $this->_docentes[$key]->setAttributes($docente);
            } elseif ($docentes instanceof Docente) {
                $this->_docentes[$docente->id] = $docente;
            }
        }
    }

}