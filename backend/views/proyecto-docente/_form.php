<?php

use common\models\Docente;
use common\models\Proyecto;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;



/** @var yii\web\View $this */
/** @var common\models\ProyectoDocente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="proyecto-docente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'proyecto_id')->widget(Select2::classname(), [

        'data' => ArrayHelper::map(Proyecto::find()->all(), 'id', 'nombre'),
        'theme' => Select2::THEME_BOOTSTRAP,
        'size' => Select2::LARGE,
        'options' => ['placeholder' => Yii::t('app', 'Select...')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model, 'docenteArray')->widget(Select2::classname(), [

        'data' => ArrayHelper::map(Docente::find()->all(), 'id', 'nombre'),
        'theme' => Select2::THEME_BOOTSTRAP,
        'size' => Select2::LARGE,
        'options' => ['placeholder' => Yii::t('app', 'Select...')],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true,
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>