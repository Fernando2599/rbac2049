<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UsuarioPermiso $model */

$this->title = 'Update Usuario Permiso: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Usuario Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'user_id' => $model->user_id, 'permiso_id' => $model->permiso_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usuario-permiso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
