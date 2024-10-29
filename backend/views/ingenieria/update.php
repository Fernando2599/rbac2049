<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Ingenieria $model */

$this->title = 'Actualizar Ingenieria' ;
$this->params['breadcrumbs'][] = ['label' => 'Ingenierias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ingenieria-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
