<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Expediente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="expediente-form" style="padding: 70px 45px 50px;">

    <div class="m-3">
        <?php
        echo '<a href="' . \yii\helpers\Url::to(['/site/index']) . '" class="btn btn-ghost-dark waves-effect waves-light">'
            . '<i class="ri-arrow-left-line"></i> Regresar'
            . '</a>';
        ?>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'perfil_estudiante_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'fecha_cierre')->textInput() ?>

    <?= $form->field($model, 'estado_expediente_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>