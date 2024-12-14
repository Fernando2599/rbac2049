<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\GradoAcademico $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="grado-academico-form">

    <div class="row">

        <div class="col-xl-12">

            <?php $form = ActiveForm::begin(); ?>

            <div class="card">

                <div class="card-body">

                    <div class="row">

                        <div class="col-sm-6">
                            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-sm-6">
                            <?= $form->field($model, 'estado')->dropDownList(
                                [1 => 'Activo', 2 => 'Inactivo'], // Opciones del dropdown
                                ['prompt' => 'Seleccione un estado'] // Opción predeterminada opcional
                            ) ?>

                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary mt-3']) ?>
                        </div>

                    </div>

                </div>

            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>

</div>