<?php

namespace backend\models;
use  backend\models\Rol;
use Yii;
use  yii\helpers\ArrayHelper;
use common\models\User;

/**
 * This is the model class for table "usuario_rol".
 *
 * @property int $id
 * @property int $user_id
 * @property int $rol_id
 */
class UsuarioRol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario_rol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'rol_id'], 'required'],
            [['user_id', 'rol_id'], 'integer'],
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
            'rol_id' => 'Rol ID',
            'userName' => Yii::t('app', 'Usuario'),
            'rolNombre' => Yii::t('app', 'Rol'),
        ];
    }

    /**
     * relación get rol
     *
     */
    public function getRol()
    {
        return $this->hasOne(Rol::className(), ['id' => 'rol_id']);
    }
    /**
     * get rol nombre
     *
     */
    public function getRolNombre()
    {
        return $this->rol ? $this->rol->rol_nombre : 'Sin rol';
    }
    /**
     * get lista de roles para lista desplegable
     */
    public static function getRolLista()
    {
        $dropciones = Rol::find()->asArray()->all();
        return ArrayHelper::map($dropciones, 'id', 'rol_nombre');
    }

    /**
     * Relación getUser
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
    * Obtener el nombre de usuario
    */
    public function getUserName()
    {
        return $this->user ? $this->user->username : 'Sin usuario';
    }
    
    /**
     * get lista de usuarios para lista desplegable
     */    
    public function getUserLista() {
        
        $users = User::find()->all(); 
        return ArrayHelper::map($users, 'id', 'username'); 
    }

    
}
