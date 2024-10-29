<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PerfilEstudiante $model */

$this->title = 'Crear Perfil Estudiante';
$this->params['breadcrumbs'][] = ['label' => 'Perfil Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-estudiante-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
