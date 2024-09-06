<?php

use common\models\Genero;
use common\models\GradoAcademico;
use common\models\Ingenieria;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;


/** @var yii\web\View $this */
/** @var common\models\AsesorInterno $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asesor-interno-form">

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

                            <?= $form->field($model, 'grado_academico_id')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(GradoAcademico::find()->all(), 'id', 'nombre'),
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'size' => Select2::LARGE,
                                'options' => ['placeholder' => Yii::t('app', 'Seleccione su grado academico')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>

                        </div>

                        <div class="col-sm-6">

                            <?= $form->field($model, 'ingenieria_id')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(Ingenieria::find()->all(), 'id', 'nombre'),
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'size' => Select2::LARGE,
                                'options' => ['placeholder' => Yii::t('app', 'Selecciona una ingenieria')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>

                        </div>

                        <div class="col-sm-6">

                            <?= $form->field($model, 'genero_id')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(Genero::find()->all(), 'id', 'nombre'),
                                'theme' => Select2::THEME_BOOTSTRAP,
                                'size' => Select2::LARGE,
                                'options' => ['placeholder' => Yii::t('app', 'Selecciona una ingenieria')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>

                        </div>

                    </div>

                    <div class="row border-top">

                        <div class="col-sm-6 mt-3">

                            <?= $form->field($model, 'capacitacion')->checkbox([
                                'class' => 'form-check-input', // Clase CSS para el checkbox
                                'template' => "<div class='form-check mb-2'>{input}\n{label}\n{error}</div>", // Plantilla para el checkbox
                                'checked' => $model->capacitacion == 2, // Verificar si está seleccionado basado en el valor del modelo
                                'uncheck' => '1', // Valor para cuando no está seleccionado
                                'value' => '2', // Valor para cuando está seleccionado
                            ])->label(false) ?>

                        </div>

                    </div>


                    <div class="form-group">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary mt-3']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>

            </div>

        </div>

    </div>










</div>