<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UsuarioRol $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuario-rol-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList($model->getUserLista(), ['prompt' => 'Por Favor Elija Uno']); ?>


    <?= $form->field($model, 'rol_id')->dropDownList($model->RolLista, [ 'prompt' => 'Por Favor Elija Uno' ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
