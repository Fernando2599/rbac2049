<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Departamento $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="departamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-xl-12">

            <div class="card">

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-md-6">

                            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary mt-3']) ?>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>