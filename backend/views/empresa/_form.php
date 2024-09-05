<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Empresa $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="empresa-form">

    <div class="row">

        <div class="col-xl-12">

            <div class="card">

                <?php $form = ActiveForm::begin(); ?>

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-sm-6 mb-3">

                            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-sm-6 mb-3">

                            <?= $form->field($model, 'domicilio')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-sm-6 mb-3">

                            <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-sm-6 mb-3">

                            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

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