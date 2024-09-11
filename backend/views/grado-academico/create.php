<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\GradoAcademico $model */

$this->title = 'Create Grado Academico';
$this->params['breadcrumbs'][] = ['label' => 'Grado Academicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grado-academico-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
