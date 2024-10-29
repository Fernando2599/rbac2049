<?php
namespace common\models;

use yii;

class RegistrosHelpers
{
    public static function userTiene($modelo_nombre)
    {
        $conexion = \Yii::$app->db;
        $userid = Yii::$app->user->identity->id;
        $sql = "SELECT id FROM $modelo_nombre WHERE user_id=:userid";
        $comando = $conexion->createCommand($sql);
        $comando->bindValue(":userid", $userid);
        $resultado = $comando->queryOne();
        if ($resultado == null) {
            return false;
        } else {
            return $resultado['id'];
        }
    }
    public static function buscarExpediente()
    {
        $conexion = \Yii::$app->db;
        $userid = Yii::$app->user->identity->id;
        $sql = "SELECT id FROM expediente WHERE perfil_estudiante_id = (SELECT id FROM perfil_estudiante WHERE user_id=:userid)";
        $comando = $conexion->createCommand($sql);
        $comando->bindValue(":userid", $userid);
        $resultado = $comando->queryOne();
        if ($resultado == null) {
            return false;
        } else {
            return $resultado['id'];
        }
    }

    public static function validarFecha($fecha_inicio, $fecha_cierre, $fecha_actual)
    {
        $fecha_inicio = strtotime($fecha_inicio);
        $fecha_cierre = strtotime($fecha_cierre);
        $fecha_actual = strtotime($fecha_actual);
        if (($fecha_actual >= $fecha_inicio) && ($fecha_actual <= $fecha_cierre))
        {
            return true;
        } else{
            return false;
        }
    }
}