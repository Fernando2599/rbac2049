<?php

use common\models\AsesorInterno;
use common\models\Ingenieria;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;



/** @var yii\web\View $this */
/** @var common\models\Asignatura $model */
/** @var yii\widgets\ActiveForm $form */


?>

<div class="asignatura-form">

    <?php $form = ActiveForm::begin();
    $dataMes = [
        "ENE" => "ENERO",
        "FEB" => "FEBRERO",
        "MAR" => "MARZO",
        "ABR" => "ABRIL",
        "MAY" => "MAYO",
        "JUN" => "JUNIO",
        "JUL" => "JULIO",
        "AGO" => "AGOSTO",
        "SEP" => "SEPTIEMBRE",
        "OCT" => "OCTUBRE",
        "NOV" => "NOVIEMBRE",
        "DIC" => "DICIEMBRE"

    ];

    $dataAnio = [
        "2022" => "2022",
        "2023" => "2023",
        "2024" => "2024",
        "2025" => "2025",
        "2026" => "2026",
        "2027" => "2027",
        "2028" => "2028",
        "2029" => "2029",
        "2030" => "2030"
    ];
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

                            <h5>Periodo de Desarrollo</h5>

                            <div class="row">
                                <div class="col">

                                    <?=
                                    $form->field($model, 'mes_inicio')->widget(Select2::classname(), [
                                        'data' => $dataMes,
                                        'theme' => Select2::THEME_BOOTSTRAP,
                                        'size' => Select2::LARGE,
                                        'options' => ['placeholder' => Yii::t('app', 'Selecionar mes')],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                                    ?>
                                </div>

                                <div class="col">
                                    <?=
                                    $form->field($model, 'anio_inicio')->widget(Select2::classname(), [
                                        'data' => $dataAnio,
                                        'theme' => Select2::THEME_BOOTSTRAP,
                                        'size' => Select2::LARGE,
                                        'options' => ['placeholder' => Yii::t('app', 'Selecionar año')],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                                    ?>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <h5>Periodo de Acreditación</h5>

                            <div class="row">

                                <div class="col-sm-6">
                                    <?=
                                    $form->field($model, 'mes_final')->widget(Select2::classname(), [
                                        'data' => $dataMes,
                                        'theme' => Select2::THEME_BOOTSTRAP,
                                        'size' => Select2::LARGE,
                                        'options' => ['placeholder' => Yii::t('app', 'Selecionar mes')],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                                    ?>
                                </div>

                                <div class="col-sm-6">
                                    <?=
                                    $form->field($model, 'anio_final')->widget(Select2::classname(), [
                                        'data' => $dataAnio,
                                        'theme' => Select2::THEME_BOOTSTRAP,
                                        'size' => Select2::LARGE,
                                        'options' => ['placeholder' => Yii::t('app', 'Selecionar año')],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
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