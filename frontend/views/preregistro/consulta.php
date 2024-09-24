<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Preregistro $model */
/** @var ActiveForm $form */


$this->title = 'Consulta';

?>

<div class="layout-wrapper landing">

    <nav class="navbar navbar-expand-lg navbar-landing fixed-top job-navbar" id="navbar">
        <div class="container-fluid custom-container">
            <a class="navbar-brand" href="index.php">
                <img src=<?php echo Url::to('@web/images/pleca_tecnm.jpg', true); ?> class="card-logo card-logo-dark" alt="logo dark" height="34">
                <img src=<?php echo Url::to('@web/images/pleca_tecnm.jpg', true); ?> class="card-logo card-logo-light" alt="logo light" height="34">
            </a>
            <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">

                    <?php

                    if (Yii::$app->user->isGuest) {

                        echo '<li class="nav-item"> '
                            . Html::a(
                                "<i class=\"fa fa-icon\"></i> "
                                    . Yii::t('app', 'Inicio'),
                                ['/site/index'],
                                ['class' => 'nav-link fw-semibold fs-15']
                            )
                            . '</li>';
                    }
                    ?>
                </ul>

                <?php
                if (Yii::$app->user->isGuest) {

                    echo '<div class="">'
                        . '<a href="' . \yii\helpers\Url::to(['/site/login']) . '" class="btn btn-soft-primary">'
                        . '<i class="ri-user-3-line align-bottom me-1"></i> Iniciar Sesion'
                        . '</a>'
                        . '</div>';
                }
                ?>
            </div>

        </div>
    </nav>



    <section class="section">

        <div class="m-3">
            <?php
            echo '<a href="' . \yii\helpers\Url::to(['/site/dual']) . '" class="btn btn-ghost-dark waves-effect waves-light">'
                . '<i class="ri-arrow-left-line"></i> Regresar'
                . '</a>';
            ?>
        </div>

        <div class=" d-flex flex-column justify-content-center align-items-center">

            <h1 class="mb-3">Consulta el estado de tu Preregistro </h1>


            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'matricula')->textInput(['placeholder' => 'Ingresa tu matricula']) ?>

            <div class="form-group">
                <?= Html::submitButton('Consultar', ['class' => 'btn btn-secondary waves-effect waves-light mt-3']) ?>
            </div>
            <?php ActiveForm::end(); ?>



        </div>



    </section>



</div><!-- site-consulta -->