<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\GradoAcademico $model */

$this->title = 'Update Grado Academico: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Grado Academicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grado-academico-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
