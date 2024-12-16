<?php

use common\models\AsesorInterno;
use common\models\Ingenieria;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use yii\helpers\Url;



/** @var yii\web\View $this */
/** @var common\models\Asignatura $model */
/** @var yii\widgets\ActiveForm $form */


?>

<div class="asignatura-form">

    <?php $form = ActiveForm::begin();
    ?>

    <div class="row">

        <div class="col-xl-12">

            <div class="card">

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-md-4">
                            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-md-3">
                            <?= $form->field($model, 'clave')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-md-2">
                            <?= $form->field($model, 'creditos')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-md-3">
                            <?= $form->field($model, 'semanas')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-md-12">
                            <?= $form->field($model, 'competencia_disciplinar')->textarea(['rows' => 3]) ?>
                        </div>



                        <div class="col-md-3">
                            <?= $form->field($model, 'semestre_id')->dropDownList($model->getSemestresList(), ['prompt' => 'Seleccione el semestre']) ?>
                        </div>

                        <div class="col-md-3">
                            <?php $ingenieriaList = ArrayHelper::map(common\models\Ingenieria::find()->all(), 'id', 'nombre'); ?>
                            <?= $form->field($model, 'ingenieria_id')->dropDownList($ingenieriaList, ['prompt' => 'Seleccione la Ingeniería', 'id' => 'nombre']); ?>
                        </div>

                        <div class="col-md-3">
                            <?php
                            echo $form->field($model, 'asesor_interno_id')->widget(DepDrop::classname(), [
                                'type' => DepDrop::TYPE_SELECT2,
                                'options' => ['id' => 'asesor_interno_id'],
                                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                'pluginOptions' => [
                                    'depends' => ['nombre'], // the id for cat attribute
                                    'placeholder' => 'Seleccione un docente',
                                    'url' =>  \yii\helpers\Url::to(['asignatura/asesores-list']),
                                    'initialize' => $model->isNewRecord ? false : true,
                                ]
                            ]);
                            ?>
                        </div>

                        <div class="col-md-3 mb-1">

                            <?php
                            echo $form->field($model, 'especialidad_id')->widget(DepDrop::classname(), [
                                'type' => DepDrop::TYPE_SELECT2,
                                'options' => ['id' => 'especialidad_id'],
                                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                'pluginOptions' => [
                                    'depends' => ['nombre'], // the id for cat attribute
                                    'placeholder' => 'Seleccione una especialidad',
                                    'url' =>  \yii\helpers\Url::to(['asignatura/especialidad-list']),
                                    'initialize' => $model->isNewRecord ? false : true,
                                ]
                            ]);
                            ?>
                            <p class="text-muted m-0">En caso de contar con especialidad</p>


                        </div>

                    </div>

                    <div class="row border-top ">
                        <div class="col-md-6 mt-3">

                            <h5>Periodo</h5>

                            <div class="row">
                                <div class="col-sm-6">

                                    <?= $form->field($model, 'periodo_desarrollo')->widget(DatePicker::classname(), [
                                        'type' => DatePicker::TYPE_INPUT,
                                        'pluginOptions' => [
                                            'todayHighlight' => true,
                                            'todayBtn' => true,
                                            'format' => 'dd-M-yyyy',
                                            'autoclose' => true,
                                        ]
                                    ]);
                                    ?>

                                </div>

                                <div class="col-sm-6">
                                    <?= $form->field($model, 'periodo_acreditacion')->widget(DatePicker::classname(), [
                                        'type' => DatePicker::TYPE_INPUT,
                                        'pluginOptions' => [
                                            'todayHighlight' => true,
                                            'todayBtn' => true,
                                            'format' => 'dd-M-yyyy',
                                            'autoclose' => true,
                                        ]
                                    ]);
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary mb-3']) ?>
                    </div>

                </div>


            </div>

        </div>




    </div>


    <?php ActiveForm::end(); ?>
</div>