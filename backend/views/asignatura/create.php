<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Asignatura $model */

$this->title = 'Crear Asignatura';
$this->params['breadcrumbs'][] = ['label' => 'Asignaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asignatura-create">

    <h4 class="mb-3"><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
