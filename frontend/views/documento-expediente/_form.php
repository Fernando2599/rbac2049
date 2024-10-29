<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var common\models\DocumentoExpediente $model */
/** @var yii\widgets\ActiveForm $form */
$this->title = 'Subir documento';
?>

<div class="documento-expediente-form" style="padding: 70px 45px 50px;">

<h1 class="text-center mt-3"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'archivo')->widget(FileInput::classname(), [
                'options' => ['accept' => 'file/*'],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['pdf'],
                    'showUpload' => false
                ]
            ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Subir documento', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
