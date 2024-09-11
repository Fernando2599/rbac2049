<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Preregistro $model */

$this->title = 'Create Preregistro';
$this->params['breadcrumbs'][] = ['label' => 'Preregistros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preregistro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
