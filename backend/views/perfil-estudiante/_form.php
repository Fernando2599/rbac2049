<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PerfilEstudiante $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="perfil-estudiante-form">

    <div class="row">

        <div class="col-xl-12">

            <div class="card">

                <?php $form = ActiveForm::begin(); ?>

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-sm-4">

                            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-sm-4">

                            <?= $form->field($model, 'matricula')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-sm-4">

                            <?= $form->field($model, 'genero_id')->textInput() ?>

                        </div>

                        <div class="col-sm-6">

                            <?= $form->field($model, 'ingenieria_id')->textInput() ?>

                        </div>

                        <div class="col-sm-6">

                            <?= $form->field($model, 'especialidad_id')->textInput() ?>

                        </div>

                        <div class="col-sm-6">

                            <?= $form->field($model, 'created_at')->textInput() ?>

                        </div>

                        <div class="col-sm-6">

                            <?= $form->field($model, 'updated_at')->textInput() ?>

                        </div>

                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>

            </div>

        </div>

    </div>












</div>