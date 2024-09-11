<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ProyectoAsignatura $model */

$this->title = 'Añadir-Quitar Asignaturas ';
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Asignaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'proyecto_id' => $model->proyecto_id, 'asignatura_id' => $model->asignatura_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="proyecto-asignatura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
