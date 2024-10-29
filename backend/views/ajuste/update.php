<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Ajuste $model */

$this->title = 'Actualizar Ajustes';
$this->params['breadcrumbs'][] = ['label' => 'Ajustes', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar información';
?>

<header>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" crossorigin="anonymous"></script>
</header>

<div class="ajuste-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
