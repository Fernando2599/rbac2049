<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */
$asignarRol = Yii::$app->urlManager->createAbsoluteUrl(['admin/assignment/view', 'id' => $user->id]);
?>
<div class="verify-email">
    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Por este medio se le informa que:</p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Html::encode($user->username) ?> ha creado y verificado su cuenta en <?= Html::encode(Yii::$app->name) ?>.</p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Favor de verficar el rol que le asignará al nuevo usuario
    </p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Para asignar el rol, por favor haga clic en el siguiente enlace: 
    </p>

    <p><?= Html::a(Html::encode($asignarRol), $asignarRol) ?></p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Si tiene problemas, por favor, pegue la dirección URL en su navegador web.
    </p>
</div>