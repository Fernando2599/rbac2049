<?php
namespace common\models;

use common\models\ValorHelpers;

use yii;
use yii\web\Controller;
use yii\helpers\Url;

class PermisosHelpers
{
    public static function requerirUpgradeA($tipo_usuario_nombre)
    {
        if (!ValorHelpers::tipoUsuarioCoincide($tipo_usuario_nombre)) {
            return Yii::$app->getResponse()->redirect(Url::to(['upgrade/index']));
        }
    }
    public static function requerirEstado($estado_nombre)
    {
        return ValorHelpers::estadoCoincide($estado_nombre);
    }
    public static function requerirRol($rol_nombre)
    {
        return ValorHelpers::rolCoincide($rol_nombre);
    }

    public static function requerirMinimoRol1($rol_nombre, $userId=null)
    {
        if (ValorHelpers::esRolNombreValido($rol_nombre)){
            if ($userId == null) {
                return ValorHelpers::getUsersRolValor(Yii::$app->user->id, $rol_nombre);
            } else {
                return ValorHelpers::getUsersRolValor($userId, $rol_nombre);
            }
        } else {
            return false;
        }
    }
    public static function validarRolesArray($roles, $userId=null)
    {
        if ($userId == null) {
            $userId = Yii::$app->user->id;
        }

        foreach ($roles as $rol_nombre) {
            if (ValorHelpers::esRolNombreValido($rol_nombre) && ValorHelpers::getUsersRolValor($userId, $rol_nombre)) {
                return true;
            }
        }

        return false;
    }
    public static function requerirMinimoRol($roles, $userId=null)
    {
        if ($userId == null) {
            $userId = Yii::$app->user->id;
        }

        foreach ($roles as $rol_nombre) {
            if (ValorHelpers::esRolNombreValido($rol_nombre) && ValorHelpers::getUsersRolValor($userId, $rol_nombre)) {
                return true;
            }
        }

        return false;
    }

    public static function requerirRolEspecifico($rol_nombre, $userId=null)
    {
        if (ValorHelpers::esRolNombreValido($rol_nombre)){
            if ($userId == null) {
                return ValorHelpers::getUsersRolValorEspecifico(Yii::$app->user->id, $rol_nombre);
            } else {
                return ValorHelpers::getUsersRolValorEspecifico($userId, $rol_nombre);
            }
        } else {
            return false;
        }
    }

    public static function requerirPermiso($permiso_nombre, $userId = null)
    {
        if (ValorHelpers::esPermisoNombreValido($permiso_nombre)) {
            // Verificar los permisos del usuario
            if ($userId == null) {
                return ValorHelpers::getUsersPermisoValor(Yii::$app->user->id, $permiso_nombre);
            } else {
                return ValorHelpers::getUsersPermisoValor($userId, $permiso_nombre);
            }
        } else {
            return false;
        }
    }


    public static function userDebeSerPropietario($model_nombre, $model_id)
    {
        $connection = \Yii::$app->db;
        $userid = Yii::$app->user->identity->id;
        $sql = "SELECT id FROM $model_nombre WHERE user_id=:userid AND id=:model_id";
        $command = $connection->createCommand($sql);
        $command->bindValue(":userid", $userid);
        $command->bindValue(":model_id", $model_id);
        if($result = $command->queryOne()) {
            return true;
        } else {
            return false;
        }
    }
}