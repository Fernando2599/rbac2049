<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\DocumentoExpediente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="documento-expediente-form">

    <div class="card">

        <?php $form = ActiveForm::begin(); ?>

        <div class="card-body">

            <div class="row mb-3">

                <?= $form->field($model, 'comentario')->textarea(['rows' => 6]) ?>

            </div>

            <div class="form-group">

                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>

            </div>

        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>