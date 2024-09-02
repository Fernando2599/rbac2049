<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Preregistro $model */

$this->title = 'Pre-Registro al Modelo Dual';
$this->params['breadcrumbs'][] = ['label' => 'Preregistros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preregistro-create">

    <h1 class="text-primary text-gradient mb-0" style="text-align:center;"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
