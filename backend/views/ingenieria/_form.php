<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Ingenieria $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ingenieria-form">

    <div class="card">

        <?php $form = ActiveForm::begin(); ?>

        <div class="card-body">

            <div class="row mb-3">

                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

            </div>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
            </div>

        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>