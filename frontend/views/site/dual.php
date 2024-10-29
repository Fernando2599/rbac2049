<?php


/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\RegistrosHelpers;

/** @var common\models\Ajuste $model */
date_default_timezone_set("America/Mexico_City");

$fecha_actual = date('Y-m-d');
$fecha_inicio = date($model->inicio_preregistro);
$fecha_cierre = date($model->fin_preregistro);

$this->title = 'Quiero ser Dual';
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

    <section class="section" id="">
        <h1 style="text-align:center;" class="text-primary text-gradient mb-0">¡Forma parte del Modelo Dual!</h2>
            <br><br>

            <div class="row row-cols-1 row-cols-md-2 m-3">


                <div class="col mb-4">
                    <!-- Card -->
                    <div class="card">

                        <!--Card image-->
                        <div class="view overlay">
                            <img class="card-img-top" src=<?php echo Url::to('@web/archivos/preregistro2.png', true); ?>
                                alt="Card image cap">
                            <a href="#!">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!--Card content-->
                        <div class="card-body">

                            <!--Title-->
                            <h4 class="card-title">Pre-registrate al Modelo Dual</h4>
                            <!--Text-->
                            <p class="card-text">¿Te gustaría ser un alumno Dual? Pre-registrate ingresando los datos y documentos
                                solicitados.</p>
                            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                            <p>
                                <?php
                                if (Yii::$app->user->isGuest) {
                                    if (RegistrosHelpers::validarFecha($fecha_inicio, $fecha_cierre, $fecha_actual)) {
                                        echo Html::a('Pre-registrarme', ['preregistro/create'], ['class' => 'btn btn-outline-primary']);
                                    } else {
                                        echo '<div class="alert alert-warning alert-border-left show">'.'<i class="ri-alert-line me-3 align-middle"></i>' . '<strong> Alerta - </strong>'.'No es posible Pre-registrarse en este momento, verifique la fecha de disponibilidad'.
                                        '</div>';
                                    }
                                }
                                ?>

                            </p>

                        </div>

                    </div>
                    <!-- Card -->
                </div>
                <div class="col mb-4">
                    <!-- Card -->
                    <div class="card">

                        <!--Card image-->
                        <div class="view overlay">
                            <img class="card-img-top" src=<?php echo Url::to('@web/archivos/consulta2.jpg', true); ?>
                                alt="Card image cap">
                            <a href="#!">
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!--Card content-->
                        <div class="card-body">

                            <!--Title-->
                            <h4 class="card-title">Consulta el estado de tu Pre-registro</h4>
                            <!--Text-->
                            <p class="card-text">¿Ya te Pre-registraste? Ahora puedes consultar el estado de tu Pre-registro
                                con tu matricula escolar.</p>
                            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                            <p>
                                <?php
                                if (Yii::$app->user->isGuest) {
                                    echo Html::a('Consultar', ['preregistro/consulta'], ['class' => 'btn btn-outline-primary']);
                                }
                                ?>
                            </p>

                        </div>

                    </div>
                </div>
            </div>
    </section>

</div>