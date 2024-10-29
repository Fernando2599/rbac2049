<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\widgets\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\Documento $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerJs('
    $(document).ready(function() {
        $(".flatpickr").flatpickr({
            locale: "es",
        });
    });
');
?>

<div class="documento-form">

    <div class="row">

        <div class="col-xl-12">

            <div class="card">

                <?php $form = ActiveForm::begin(); ?>

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-sm-12">

                            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-sm-12">

                            <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <?php echo $form->field($model, 'fecha_inicio')->widget(DatePicker::className(), [
                                'class' => 'form-control flatpickr',
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'layout' => '{picker}{input}{remove}',
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'todayHighlight' => true,
                                    'todayBtn' => true,
                                    'format' => 'yyyy-mm-dd',
                                ]
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?php echo $form->field($model, 'fecha_cierre')->widget(DatePicker::className(), [
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'layout' => '{picker}{input}{remove}',
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'todayHighlight' => true,
                                    'todayBtn' => true,
                                    'format' => 'yyyy-mm-dd',
                                ]
                            ]) ?>
                        </div>

                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary mt-3']) ?>
                    </div>

                </div>

            </div>

        </div>
    </div>









    <?php ActiveForm::end(); ?>

</div>