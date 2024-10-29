<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ProyectoDocente $model */

$this->title = 'Create Proyecto Docente';
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Docentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-docente-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
