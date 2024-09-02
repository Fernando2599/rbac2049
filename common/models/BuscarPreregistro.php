<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class BuscarPreregistro extends Model
{
    public $matricula;

    public $_preregistro;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['matricula'], 'required'],
        ];
    }


    /**
     *
     * @return bool whether the preregistro is logged in successfully
     */
    public function searchPreregistro()
    {
        if ($this->validate()) {
            return Yii::$app->buscarPreregistro->searchPreregistro($this->getPreregistro());
        }
        
        return false;
    }

    /**
     * Finds preregistro by [[matricula]]
     *
     * @return Preregistro|null
     */
    public function getPreregistro()
    {
        if ($this->_preregistro === null) {
            $this->_preregistro = Preregistro::findByMatricula($this->matricula);
        }

        return $this->_preregistro;
    }

}