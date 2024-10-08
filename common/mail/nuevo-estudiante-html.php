<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */
/** @var common\models\Preregistro $preregistro */
/** @var common\models\Preregistro $pass */
$frontendUrl = Yii::$app->urlManagerFrontEnd->baseUrl . '/index.php?r=site/login';

?>
<div class="verify-email">
    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Hola <?= Html::encode($preregistro->nombre) ?>,</p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Te informamos que tu pre-registro al Modelo Dual fue aceptado.</p>
    
    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Por lo tanto, su cuenta en el <?= Html::encode(Yii::$app->name) ?>, ha sido creada.</p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Sus datos de acceso son los siguientes: 
    </p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Usuario: <?= Html::encode($user->username) ?>
    </p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Contraseña: <?= Html::encode($pass) ?>
    </p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Puede ingresar al <?= Html::encode(Yii::$app->name) ?> en el siguiente enlace:
    </p>

    <p><?= Html::a(Html::encode($frontendUrl), $frontendUrl) ?></p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    PD: Si ha recibido este correo electrónico por error, simplemente elimínelo. 
    </p>
</div>