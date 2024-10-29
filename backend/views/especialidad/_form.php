<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Especialidad $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="especialidad-form">

    <div class="row">

        <div class="col-xl-12">

            <div class="card">

                <?php $form = ActiveForm::begin(); ?>

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-md-6">

                            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-md-6">

                            <?= $form->field($model, 'ingenieria_id')->dropDownList($model->getIngenieriasList(), ['prompt' => 'Seleccione la Ingeniería']) ?>

                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary mt-3']) ?>
                        </div>

                    </div>

                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div>
    </div>



</div>