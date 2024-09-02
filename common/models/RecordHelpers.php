<?php
namespace common\models;


class RecordHelpers
{
    public static function getUserName($id)
    {
        if ($user = User::findIdentity($id))
            return $user->username;
        else
            return '';
    }
}