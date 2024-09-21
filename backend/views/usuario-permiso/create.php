<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UsuarioPermiso $model */

$this->title = 'Create Usuario Permiso';
$this->params['breadcrumbs'][] = ['label' => 'Usuario Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-permiso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
