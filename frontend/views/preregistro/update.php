<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Preregistro $model */

$this->title = 'Actualizar Preregistro: ' . $model->matricula;
$this->params['breadcrumbs'][] = ['label' => 'Preregistros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="preregistro-update">

<h1 class="text-primary text-gradient mb-0" style="text-align:center;"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
