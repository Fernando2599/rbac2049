<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Expediente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="expediente-form">

    <div class="row">

        <div class="col-xl-12">

            <div class="card">

                <?php $form = ActiveForm::begin(); ?>

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-sm-12">

                            <?= $form->field($model, 'motivo_cierre_id')->dropDownList($model->getMotivoCierreList(), ['prompt' => 'Seleccione el motivo']) ?>

                        </div>

                        <div class="col-sm-12">

                            <?= $form->field($model, 'comentario')->textarea(['rows' => 6]) ?>

                        </div>

                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                    </div>

                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div>

    </div>







</div>