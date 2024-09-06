<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AsesorInterno $model */

$this->title = 'Actualizar Asesor Interno: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Asesor Internos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="asesor-interno-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
