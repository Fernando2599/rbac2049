<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Preregistro $preregistro */

$frontendUrl = Yii::$app->urlManagerFrontEnd->baseUrl . '/index.php?r=preregistro/consulta';

?>
<div class="verify-email">
    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Hola <?= Html::encode($preregistro->nombre) ?>,</p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Te informamos que el estado de tu preregistro ha cambiado.</p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Por favor, verifica la retroalimentación proporcionada en el siguiente enlace:
    </p>

    <p><?= Html::a(Html::encode($frontendUrl), $frontendUrl) ?></p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Si tiene problemas, por favor, pegue la dirección URL en su navegador web.</p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    PD: Si ha recibido este correo electrónico por error, simplemente elimínelo. 
    </p>
</div>