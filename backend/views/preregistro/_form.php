<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Preregistro $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="preregistro-form">

    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'estado_registro_id')->dropDownList($model->getEstadoRegistroNombreList(), ['prompt' => 'Seleccione un estado']) ?>

            <?= $form->field($model, 'comentario')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary mt-3']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>