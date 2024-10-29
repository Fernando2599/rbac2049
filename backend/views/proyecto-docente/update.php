<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ProyectoDocente $model */

$this->title = 'Update Proyecto Docente: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'proyecto_id' => $model->proyecto_id, 'docente_id' => $model->docente_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="proyecto-docente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
