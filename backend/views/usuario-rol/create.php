<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UsuarioRol $model */

$this->title = 'Create Usuario Rol';
$this->params['breadcrumbs'][] = ['label' => 'Usuario Rols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-rol-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
