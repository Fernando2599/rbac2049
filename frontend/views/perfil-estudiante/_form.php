<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\PerfilEstudiante $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerCss("
    .perfil-estudiante-form{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-flow: column wrap;
        border-radius: 5px;
        padding:20px;
        
    }

    #w0{

        width: 75%;
    }
    label, .perfil-estudiante-form {
        font-size:18px;
        
    }
    .help-block{
        color: #fd5c70;
    }    
    
    .form-control {
        font-size:18px;
    }

    .btn-primary {
        color: #fff;
        background-color: #03459a !important;
        border-color: #cb0c9f;
    }

    .input-group:not(.has-validation) > :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu), .input-group:not(.has-validation) > .dropdown-toggle:nth-last-child(n + 3) {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        font-size:12px;
    }

    .custom-control-label {
        position: relative;
        margin-bottom: 0;
        vertical-align: top;
        text-align: justify;
    }
    
    ");

?>

<div class="perfil-estudiante-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'matricula')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?php $ingenieriaList=ArrayHelper::map(common\models\Ingenieria::find()->all(), 'id', 'nombre' ); ?> 
            <?= $form->field($model, 'ingenieria_id')->dropDownList($ingenieriaList, ['prompt' => 'Seleccione la Ingeniería', 'id'=>'nombre']); ?>
        </div>

        <div class="col-md-6">
        <?php
            echo $form->field($model, 'especialidad_id')->widget(DepDrop::classname(), [
                'type' => DepDrop::TYPE_SELECT2,
                'options'=>['id'=>'especialidad_id'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions'=>[
                'depends'=>['nombre'], // the id for cat attribute
                'placeholder'=>'Seleccione una especialidad',
                'url'=>  \yii\helpers\Url::to(['perfil-estudiante/especialidades-list']),
                'initialize' => $model->isNewRecord ? false : true,
                ]
                ]);
            ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'genero_id')->dropDownList($model->generoLista, ['prompt' => 'Por favor Seleccione Uno' ]);?>
        </div>
        
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn bg-gradient-info btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
