<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AsesorExterno $model */

$this->title = 'Crear Asesor Externo';
$this->params['breadcrumbs'][] = ['label' => 'Asesor Externos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asesor-externo-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
