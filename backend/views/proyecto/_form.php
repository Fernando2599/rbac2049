<?php

use common\models\AsesorExterno;
use common\models\Empresa;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var common\models\Proyecto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<!-- Row -->
<div class="row">

    <div class="col-xl-12">

        <div class="card ">

            <?php $form = ActiveForm::begin(); ?>

            <div class="card-body">

                <div class="row">

                    <div class="col-sm-6">

                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>

                    </div>

                    <div class="col-sm-6 ">

                        <?= $form->field($model, 'plan_estudios_id')->dropDownList($model->getPlanEstudiosList(), ['prompt' => 'Seleccione el plan de estudio', 'class' => 'default-select form-control', 'id' => 'validationCustom01']) ?>

                    </div>

                    <div class="col-sm-6 ">

                        <?= $form->field($model, 'departamento_id')->dropDownList($model->getDepartamentoList(), ['prompt' => 'Seleccione el departamento', 'class' => 'default-select form-control', 'id' => 'validationCustom01']) ?>

                    </div>

                    <div class="col-sm-6">

                        <?php $ingenieriaList = ArrayHelper::map(common\models\Ingenieria::find()->all(), 'id', 'nombre'); ?>
                        <?= $form->field($model, 'ingenieria_id')->dropDownList($ingenieriaList, ['prompt' => 'Seleccione la Ingeniería', 'id' => 'nombre', 'class' => 'default-select form-control']); ?>

                    </div>

                    <div class="col-sm-6">

                        <?= $form->field($model, 'perfil_estudiante_id')->widget(DepDrop::classname(), [
                            'type' => DepDrop::TYPE_SELECT2,
                            'options' => ['id' => 'perfil_estudiante_id'],
                            'select2Options' => [
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ],
                            'pluginOptions' => [
                                'depends' => ['nombre'], // el id para el atributo cat
                                'placeholder' => 'Seleccione un estudiante',
                                'url' => \yii\helpers\Url::to(['proyecto/estudiantes-list']),
                                'initialize' => $model->isNewRecord ? false : true,
                            ],

                        ])->label(false);
                        ?>

                    </div>

                    <div class="col-sm-6">

                        <?= $form->field($model, 'asesor_interno_id')->widget(DepDrop::classname(), [
                            'type' => DepDrop::TYPE_SELECT2,
                            'options' => ['id' => 'asesor_interno_id'],
                            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                            'pluginOptions' => [
                                'depends' => ['nombre'], // the id for cat attribute
                                'placeholder' => 'Seleccione un asesor',
                                'url' =>  \yii\helpers\Url::to(['proyecto/asesores-internos-list']),
                                'initialize' => $model->isNewRecord ? false : true,
                            ]
                        ]);
                        ?>

                    </div>

                    <div class="col-sm-6">

                        <?php $empresaList = ArrayHelper::map(common\models\Empresa::find()->all(), 'id', 'nombre'); ?>
                        <?= $form->field($model, 'empresa_id')->dropDownList($empresaList, ['prompt' => 'Seleccione la empresa', 'id' => 'nombre2', 'class' => 'default-select form-control']); ?>

                    </div>

                    <div class="col-sm-6">

                        <?= $form->field($model, 'asesor_externo_id')->widget(DepDrop::classname(), [
                            'type' => DepDrop::TYPE_SELECT2,
                            'options' => ['id' => 'asesor_externo_id'],
                            'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                            'pluginOptions' => [
                                'depends' => ['nombre2'], // the id for cat attribute
                                'placeholder' => 'Seleccione un asesor externo',
                                'url' =>  \yii\helpers\Url::to(['proyecto/asesores-externos-list']),
                                'initialize' => $model->isNewRecord ? false : true,
                            ]
                        ]);
                        ?>

                    </div>

                    <div class="col-sm-4">

                        <?= $form->field($model, 'periodo_id')->dropDownList($model->getPeriodoList(), ['prompt' => 'Seleccione un periodo', 'class' => 'default-select form-control']) ?>

                    </div>

                    <div class="col-sm-4">

                        <?= $form->field($model, 'semestre_id')->dropDownList($model->getSemestreList(), ['prompt' => 'Seleccione su semestre', 'class' => 'default-select form-control']) ?>

                    </div>

                    <div class="col-sm-4">

                        <?= $form->field($model, 'estado_proyecto_id')->dropDownList($model->getEstadoProyectosList(), ['prompt' => 'Seleccione el estado del proyecto', 'class' => 'default-select form-control']) ?>

                    </div>

                    <div class="col-sm-12 mb-3">

                        <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

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
</div>
</div>


</div>