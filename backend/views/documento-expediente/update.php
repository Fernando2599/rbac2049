<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\DocumentoExpediente $model */

$this->title = 'Actualizar Comentario: ' ;
$this->params['breadcrumbs'][] = ['label' => 'Documento Expedientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->documento_id, 'url' => ['view', 'documento_id' => $model->documento_id, 'expediente_id' => $model->expediente_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="documento-expediente-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
