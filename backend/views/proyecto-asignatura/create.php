<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ProyectoAsignatura $model */

$this->title = 'Create Proyecto Asignatura';
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Asignaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-asignatura-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
