<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UsuarioRol $model */

$this->title = 'Update Usuario Rol: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Usuario Rols', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'user_id' => $model->user_id, 'rol_id' => $model->rol_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usuario-rol-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>