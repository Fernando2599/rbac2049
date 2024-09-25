<?php
namespace common\models;
use yii;
use backend\models\Rol;
use backend\models\Estado;
use backend\models\TipoUsuario;
use backend\models\UsuarioPermiso;
use backend\models\UsuarioRol;
use common\models\User;
use backend\models\Permiso;

class ValorHelpers
{
    public static function rolCoincide($rol_nombre)
    {
        // Se obtiene el ID del usuario autenticado
        $user_id = Yii::$app->user->id;

        // Se busca el registro en la tabla usuario_rol
        $usuarioRol = UsuarioRol::findOne(['user_id' => $user_id]);

        // Verificar si el usuario tiene un rol asignado
        if ($usuarioRol) {
            // Obtener el nombre del rol del usuario
            $userTieneRolNombre = $usuarioRol->rolNombre;

            // Comparar el rol del usuario con el rol proporcionado
            return $userTieneRolNombre == $rol_nombre;
        }
        // Si no tiene rol, retornar false
        return false;
    }

    public static function getUsersRolValor($userId = null)
    {
        // Si no se proporciona un userId, se usa el usuario autenticado
        if ($userId === null) {
            $userId = Yii::$app->user->id; // ID del usuario autenticado
        }

        // Buscar el registro en la tabla usuario_rol basado en el userId
        $usuarioRol = UsuarioRol::findOne(['user_id' => $userId]);

        // Verificar si el usuario tiene un rol asignado
        if ($usuarioRol) {
            // Obtener el valor del rol del usuario
            $rolValor = $usuarioRol->rol ? $usuarioRol->rol->rol_valor : null; // Acceso seguro al rol
            return isset($rolValor) ? $rolValor : false; // Retornar el valor o false si no está definido
        }
        // Si el usuario no tiene un rol asignado, retornar false
        return false;
    }
    public static function getUsersPermisoValor($userId=null)
    {
        // Si no se proporciona un userId, se usa el usuario autenticado
        if ($userId === null) {
            $userId = Yii::$app->user->id; // ID del usuario autenticado
        }

        // Buscar el registro en la tabla usuario_rol basado en el userId
        $usuarioPermiso = UsuarioPermiso::findOne(['permiso_id' => $userId]);

        // Verificar si el usuario tiene un rol asignado
        if ($usuarioPermiso) {
            // Obtener el valor del rol del usuario
            $permisoValor = $usuarioPermiso->permiso ? $usuarioPermiso->rol->permiso_valor : null; // Acceso seguro al rol
            return isset($permisoValor) ? $permisoValor : false; // Retornar el valor o false si no está definido
        }
        // Si el usuario no tiene un rol asignado, retornar false
        return false;
    }
    
    public static function getRolValor($rol_nombre)
    {
        $rol = Rol::find('rol_valor')
            ->where(['rol_nombre' => $rol_nombre])
            ->one();
        return isset($rol->rol_valor) ? $rol->rol_valor : false;
    }
    public static function getPermisoValor($permiso_nombre)
    {
        $permiso = Permiso::find('permiso_valor')
            ->where(['permiso_nombre' => $permiso_nombre])
            ->one();
        return isset($permiso->permiso_valor) ? $permiso->permiso_valor : false;
    }

    public static function esRolNombreValido($rol_nombre)
    {
        $rol = Rol::find('rol_nombre')
            ->where(['rol_nombre' => $rol_nombre])
            ->one();
        return isset($rol->rol_nombre) ? true : false;
    }
    public static function esPermisoNombreValido($permiso_nombre)
    {
        $permiso = Permiso::find('permiso_nombre')
            ->where(['permiso_nombre' => $permiso_nombre])
            ->one();
        return isset($permiso->permiso_nombre) ? true : false;
    }
    public static function estadoCoincide($estado_nombre)
    {
        $userTieneEstadoName = Yii::$app->user->identity->estado->estado_nombre;
        return $userTieneEstadoName == $estado_nombre ? true : false;
    }

    public static function getEstadoId($estado_nombre)
    {
        $estado = Estado::find('id')
            ->where(['estado_nombre' => $estado_nombre])
            ->one();
        return isset($estado->id) ? $estado->id : false;
    }

    public static function tipoUsuarioCoincide($tipo_usuario_nombre)
    {
        $userTieneTipoUsurioName = Yii::$app->user->identity->tipoUsuario->tipo_usuario_nombre;
        return $userTieneTipoUsurioName == $tipo_usuario_nombre ? true : false;
    }


}