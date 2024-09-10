<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Ajuste $model */

$this->title = 'Create Ajuste';
$this->params['breadcrumbs'][] = ['label' => 'Ajustes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<header>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" crossorigin="anonymous"></script>
</header>

<div class="ajuste-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
