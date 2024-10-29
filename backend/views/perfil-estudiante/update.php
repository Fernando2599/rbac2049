<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PerfilEstudiante $model */

$this->title = 'Actualizacion de Estudiante: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Perfil Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="perfil-estudiante-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
