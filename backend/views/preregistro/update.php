<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Preregistro $model */

$this->title = 'Actualizar estado: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Preregistros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar estado';
?>
<div class="preregistro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
