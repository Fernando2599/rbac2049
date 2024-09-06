<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AsesorInterno $model */

$this->title = 'Crear Asesor Interno';
$this->params['breadcrumbs'][] = ['label' => 'Asesor Internos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asesor-interno-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
