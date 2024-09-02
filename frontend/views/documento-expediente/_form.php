<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var common\models\DocumentoExpediente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="documento-expediente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'archivo')->widget(FileInput::classname(), [
                'options' => ['accept' => 'file/*'],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['pdf'],
                    'showUpload' => false
                ]
            ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Subir documento', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
