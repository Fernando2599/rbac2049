<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\PreregistroSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="preregistro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'matricula') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'ingenieria_id') ?>

    <?php // echo $form->field($model, 'kardex') ?>

    <?php // echo $form->field($model, 'constancia_ingles') ?>

    <?php // echo $form->field($model, 'constancia_servicio_social') ?>

    <?php // echo $form->field($model, 'constancia_creditos_complementarios') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'estado_registro_id') ?>

    <?php // echo $form->field($model, 'comentario') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
