<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Preregistro $model */
/** @var ActiveForm $form */

$this->registerCss("
    
    .preregistro-form{
        width: 90%;
        display: flex;
        justify-content: center;
        flex-flow: column wrap;
        border-radius: 5px;
        
    }
    label, .preregistro-form {
        font-size:20px;
        
    }

    .help-block{
        color: #fd5c70;
    }    
    
    .form-control {
        font-size:20px;
    }
    
    ");

    $this->title = 'Consulta';

?>

<div class="site-consulta">

<h1>Consulta el estado de tu Preregistro </h1>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'matricula') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Consultar', ['class' => 'btn bg-gradient-info ']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-consulta -->