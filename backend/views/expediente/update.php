<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Expediente $model */

$this->title = 'Cerrar Expediente: ' . $model->perfilEstudiante->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes Duales', 'url' => ['perfil-estudiante/index']];
$this->params['breadcrumbs'][] = ['label' => 'Expediente: ' . $model->perfilEstudiante->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expediente-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
