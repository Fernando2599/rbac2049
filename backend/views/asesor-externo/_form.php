<?php

use common\models\Empresa;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\AsesorExterno $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asesor-externo-form">

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <?php $form = ActiveForm::begin(); ?>

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-sm-6">

                            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                        </div>

                        <div class="col-sm-6">

                            <?= $form->field($model, 'empresa_id')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(Empresa::find()->all(), 'id', 'nombre'),
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'size' => Select2::LARGE,
                                'options' => ['placeholder' => Yii::t('app', 'Selecciona una empresa')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>

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