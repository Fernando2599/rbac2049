<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\AsignaturaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asignatura-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'clave') ?>

    <?= $form->field($model, 'creditos') ?>

    <?= $form->field($model, 'competencia_disciplinar') ?>

    <?php // echo $form->field($model, 'asesor_interno_id') ?>

    <?php // echo $form->field($model, 'horas_dedicadas') ?>

    <?php // echo $form->field($model, 'periodo_desarrollo') ?>

    <?php // echo $form->field($model, 'periodo_acreditacion') ?>

    <?php // echo $form->field($model, 'ingenieria_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
