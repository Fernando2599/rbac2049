<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Especialidad $model */

$this->title = 'Crear Especialidad';
$this->params['breadcrumbs'][] = ['label' => 'Especialidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especialidad-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
