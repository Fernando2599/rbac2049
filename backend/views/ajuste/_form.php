<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\widgets\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\Ajuste $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ajuste-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email_admin')->textInput() ?>

    <?= $form->field($model, 'num_semanas_semestre')->textInput() ?>

    <div class="row">
        <div class="col-md-6">
            <?php echo $form->field($model,'inicio_preregistro')->
                    widget(DatePicker::className(),[
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
            <?php echo $form->field($model,'fin_preregistro')->
                        widget(DatePicker::className(),[
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
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
