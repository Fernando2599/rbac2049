<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PerfilEstudiante $model */

$this->title = 'Create Perfil Estudiante';
$this->params['breadcrumbs'][] = ['label' => 'Perfil Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-estudiante-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
