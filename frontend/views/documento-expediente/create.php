<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\DocumentoExpediente $model */

$this->title = 'Subir documento';
$this->params['breadcrumbs'][] = ['label' => 'Documento Expedientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-expediente-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
