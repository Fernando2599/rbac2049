<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UsuarioPermiso $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuario-permiso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList($model->getUserLista(), ['prompt' => 'Por Favor Elija Uno']); ?>


    <?= $form->field($model, 'permiso_id')->dropDownList($model->PermisoLista, [ 'prompt' => 'Por Favor Elija Uno' ]);?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
