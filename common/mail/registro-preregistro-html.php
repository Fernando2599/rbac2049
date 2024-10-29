<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Preregistro $preregistro */

$consultaLink = Yii::$app->urlManager->createAbsoluteUrl(['/preregistro/consulta']);

?>
<div class="verify-email">
    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Hola <?= Html::encode($preregistro->nombre) ?>,</p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Te informamos que tu Pre-reregistro en el <?= Html::encode(Yii::$app->name) ?> ha sido creado de manera exitosa.</p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Puedes consultar el estado de tu Pre-registro en el siguiente enlace:
    </p>

    <p><?= Html::a(Html::encode($consultaLink), $consultaLink) ?></p>

    <p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    Si tiene problemas, por favor, pegue la dirección URL en su navegador web.
    </p>
</div>