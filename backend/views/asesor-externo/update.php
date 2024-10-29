<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AsesorExterno $model */

$this->title = 'Actualizar Asesor Externo: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Asesor Externos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="asesor-externo-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
