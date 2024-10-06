<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Sistema Dual';

use yii\helpers\Url;
use  common\models\PermisosHelpers;

$asset = frontend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;
?>

<?php if (Yii::$app->session->hasFlash('success')) : ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('success'); ?>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('warning')) : ?>
    <div class="alert alert-warning">
        <?= Yii::$app->session->getFlash('warning'); ?>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger">
        <?= Yii::$app->session->getFlash('error'); ?>
    </div>
<?php endif; ?>

<?php
$es_estudiante = PermisosHelpers::requerirPermiso('CoordinadorSistemas');
//$es_estudiante = PermisosHelpers::requerirMinimoRol('Estudiante');

if (!Yii::$app->user->isGuest && $es_estudiante) { ?>

    <!-- Begin page -->
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

                    </ul>

                    <?php
                    if (Yii::$app->user->isGuest) {

                        echo '<div class="">'
                            . '<a href="' . \yii\helpers\Url::to(['/site/login']) . '" class="btn btn-soft-primary">'
                            . '<i class="ri-user-3-line align-bottom me-1"></i> Iniciar Sesion'
                            . '</a>'
                            . '</div>';
                    } else {


                        echo Html::a(
                            "<i class=\"fa fa-icon\"></i> "
                                . Yii::t('app', 'Usuario (' . Yii::$app->user->identity->username . ' <i class="fa fa-user-circle-o" aria-hidden="true"></i>)'),
                            ['/perfil-estudiante/index'],
                            ['class' => 'nav-link fw-semibold fs-15 me-3']
                        );

                        echo Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                'Cerrar sesion <i class="fa fa-sign-in" aria-hidden="true"></i>',
                                ['class' => 'btn btn-primary']
                            )
                            . Html::endForm();
                    }
                    ?>
                </div>

            </div>
        </nav>


        <section style="padding: 70px 45px 50px;">
            <h1 class="text-primary text-gradient mb-3 text-center">Gestor de expediente</h2>

                <div class="d-flex justify-content-center align-items-center">


                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col mb-4">
                            <!-- Card -->
                            <div class="card">

                                <!--Card image-->
                                <div class="view overlay">
                                    <img class="card-img-top" src=<?php echo Url::to('@web/archivos/expediente.jpg', true); ?> alt="Card image cap">
                                    <a href="#!">
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>

                                <!--Card content-->
                                <div class="card-body">

                                    <!--Title-->
                                    <h4 class="card-title">Expediente</h4>
                                    <!--Text-->
                                    <hr>
                                    <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                                    <p>
                                        <?php
                                        if (!Yii::$app->user->isGuest) {
                                            echo Html::a('Acceder', ['expediente/view'], ['class' => 'btn btn-outline-primary']);
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
                                    <img class="card-img-top" src=<?php echo Url::to('@web/archivos/documento.webp', true); ?> alt="Card image cap">
                                    <a href="#!">
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>

                                <!--Card content-->
                                <div class="card-body">

                                    <!--Title-->
                                    <h4 class="card-title">Documentos pendientes</h4>
                                    <!--Text-->
                                    <hr>
                                    <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                                    <p>
                                        <?php
                                        if (!Yii::$app->user->isGuest) {
                                            echo Html::a('Acceder', ['documento/index'], ['class' => 'btn btn-outline-primary']);
                                        }
                                        ?>
                                    </p>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
        </section>





    </div>


<?php } else { ?>

    <!-- Begin page -->
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
                        <li class="nav-item">
                            <a class="nav-link fw-semibold fs-15 active" href="#inicio">inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold fs-15" href="#acerca">Acerca de</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold fs-15" href="#proceso">Proceso</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold fs-15" href="#experiencia">Experiencia</a>
                        </li>

                        <?php

                        if (Yii::$app->user->isGuest) {

                            echo '<li class="nav-item"> '
                                . Html::a(
                                    "<i class=\"fa fa-icon\"></i> "
                                        . Yii::t('app', 'Quiero ser Dual'),
                                    ['/site/dual'],
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
                    } else {


                        echo Html::a(
                            "<i class=\"fa fa-icon\"></i> "
                                . Yii::t('app', 'Usuario (' . Yii::$app->user->identity->username . ' <i class="fa fa-user-circle-o" aria-hidden="true"></i>)'),
                            ['/perfil-estudiante/index'],
                            ['class' => 'nav-link fw-semibold fs-15 me-3']
                        );

                        echo Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                'Cerrar sesion <i class="fa fa-sign-in" aria-hidden="true"></i>',
                                ['class' => 'btn btn-primary']
                            )
                            . Html::endForm();
                    }
                    ?>
                </div>

            </div>
        </nav>

        <!-- start hero section -->
        <section class="section job-hero-section bg-light pb-0" id="inicio">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6">
                        <div>

                            <h1 class="display-6 fw-bold text-capitalize mb-3 lh-base">Termina Tu Carrera En Un Empresa</h1>

                            <p class="lead text-muted lh-base mb-4">Pre-registrate y forma parte del Modelo de Educación Dual y Termina tu carrera adquiriendo experiencia en las mejores empresas de la región.</p>

                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="position-relative home-img text-center mt-5 mt-lg-0">
                            <div class="card p-3 rounded shadow-lg inquiry-box">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0 me-3">
                                        <div class="avatar-title bg-warning-subtle text-warning rounded fs-18">
                                            <i class="ri-mail-send-line"></i>
                                        </div>
                                    </div>
                                    <h5 class="fs-15 lh-base mb-0">Comienza tu proceso</h5>
                                </div>
                            </div>

                            <img src=<?php echo Url::to('@web/images/job-profile2.png', true); ?> alt="" class="user-img">

                            <div class="circle-effect">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                <div class="circle3"></div>
                                <div class="circle4"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end hero section -->

        <!-- start features -->
        <section class="section" id="acerca">
            <div class="container">
                <div class="row align-items-center justify-content-lg-between justify-content-center gy-4">

                    <div class="col-lg-5 col-sm-7">
                        <div class="about-img-section mb-5 mb-lg-0 text-center">

                            <img src=<?php echo Url::to('@web/images/about.jpg', true); ?> alt="" class="img-fluid mx-auto rounded-3" />

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="text-muted">
                            <h1 class="mb-3 lh-base">¿Qué es el modelo de <span class="text-primary">Educación Dual</span>?</h1>
                            <p class="ff-secondary fs-16">El modelo dual es un sistema educativo innovador que combina la teoría académica con la práctica profesional. A través de este modelo, los estudiantes tienen la oportunidad de adquirir experiencia laboral en empresas relacionadas con su campo de estudio mientras completan su formación académica.</p>

                            <div class="vstack gap-2 mb-4 pb-1">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <div class="avatar-xs icon-effect">
                                            <div class="avatar-title bg-transparent text-success rounded-circle h2">
                                                <i class="ri-check-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Experiencia Práctica.</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <div class="avatar-xs icon-effect">
                                            <div class="avatar-title bg-transparent text-success rounded-circle h2">
                                                <i class="ri-check-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Mejora de Competencias.</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <div class="avatar-xs icon-effect">
                                            <div class="avatar-title bg-transparent text-success rounded-circle h2">
                                                <i class="ri-check-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Oportunidades Laborales.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end features -->

        <section class="section" id="proceso">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h1 class="mb-3 fw-semibold lh-base">¿Cómo funciona el<span class="text-primary"> Modelo dual</span>?</h1>
                            <p class="text-muted">Sigue estos simples pasos para formar parte del sistema de educación dual y titularte mientras obtienes experiencia en una empresa..</p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!--end row-->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-lg">
                            <div class="card-body p-4">
                                <h1 class="fw-bold display-5 ff-secondary mb-4 text-success position-relative">
                                    <div class="job-icon-effect"></div>
                                    <span>1</span>
                                </h1>
                                <h6 class="fs-17 mb-2">Pre-registro</h6>
                                <p class="text-muted mb-0 fs-15">Completa tu pre-registro con los datos solicitados.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-none">
                            <div class="card-body p-4">
                                <h1 class="fw-bold display-5 ff-secondary mb-4 text-success position-relative">
                                    <div class="job-icon-effect"></div>
                                    <span>2</span>
                                </h1>
                                <h6 class="fs-17 mb-2">Colocación en Empresa</h6>
                                <p class="text-muted mb-0 fs-15">Se asigna al estudiante a un empresa.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-none">
                            <div class="card-body p-4">
                                <h1 class="fw-bold display-5 ff-secondary mb-4 text-success position-relative">
                                    <div class="job-icon-effect"></div>
                                    <span>3</span>
                                </h1>

                                <h6 class="fs-17 mb-2">Supervisión y Evaluación</h6>
                                <p class="text-muted mb-0 fs-15">Se realiza el seguiento para que se cumplan los objetivos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card shadow-none">
                            <div class="card-body p-4">
                                <h1 class="fw-bold display-5 ff-secondary mb-4 text-success position-relative">
                                    <div class="job-icon-effect"></div>
                                    <span>4</span>
                                </h1>
                                <h6 class="fs-17 mb-2">Graduación</h6>
                                <p class="text-muted mb-0 fs-15">Al finalizar el programa, los estudiantes están preparados para ingresar al mercado laboral con una ventaja competitiva significativa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end container-->
        </section>

        <!-- start services -->
        <section class="section bg-light" id="experiencia">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h1 class="mb-3 fw-semibold text-capitalize lh-base">Algunas <span class="text-primary">Demostraciones</span></h1>
                            <p class="text-muted mb-4">Éstas son solo una pequeña prueba de alumnos trabajando en una empresa!.</p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="swiper candidate-swiper">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="card text-center">
                                        <div class="card-body p-4">
                                            <img src=<?php echo Url::to('@web/archivos/admin.png', true); ?> alt="" class="img-fluid rounded">
                                            <h5 class="fs-17 mt-3 mb-2">Ing en Administracion de Empresas</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card text-center">
                                        <div class="card-body p-4">
                                            <img src=<?php echo Url::to('@web/archivos/ambiental.png', true); ?> alt="" class="img-fluid rounded">
                                            <h5 class="fs-17 mt-3 mb-2">Ing Ambiental</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card text-center">
                                        <div class="card-body p-4">
                                            <img src=<?php echo Url::to('@web/archivos/civil.jpg', true); ?> alt="" class="img-fluid rounded">
                                            <h5 class="fs-17 mt-3 mb-2">Ing Civil</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card text-center">
                                        <div class="card-body p-4">
                                            <img src=<?php echo Url::to('@web/archivos/industrial.png', true); ?> alt="" class="img-fluid rounded">
                                            <h5 class="fs-17 mt-3 mb-2">Ing Industrial</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card text-center">
                                        <div class="card-body p-4">
                                            <img src=<?php echo Url::to('@web/archivos/ambiental.png', true); ?> alt="" class="img-fluid rounded">
                                            <h5 class="fs-17 mt-3 mb-2">Ing en Gestión Empresarial</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card text-center">
                                        <div class="card-body p-4">
                                            <img src=<?php echo Url::to('@web/archivos/sistemas.png', true); ?> alt="" class="img-fluid rounded">
                                            <h5 class="fs-17 mt-3 mb-2">Ing en Sistemas Computacionales</h5>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end container -->
        </section>
        <!-- end services -->

        <!-- start cta -->
        <?php if (Yii::$app->user->isGuest) { ?>
            <section class="py-5 bg-primary position-relative">
                <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
                <div class="container">
                    <div class="row align-items-center gy-4">
                        <div class="col-sm">
                            <div>
                                <h4 class="text-white fw-semibold">Comienza ahora!</h4>
                                <p class="text-white text-opacity-75 mb-0">Completa tu pre-registro para comenzar tu proceso dual.</p>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-auto">
                            <?php
                            echo Html::a(
                                Yii::t('app', 'Quiero ser Dual') . "<i class='ri-arrow-right-line align-bottom'></i> ",
                                ['/site/dual'],
                                ['class' => 'btn btn-danger']
                            )
                            ?>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </section>
            <!-- end cta -->
        <?php } ?>

        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-info btn-icon landing-back-top" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

    </div>
    <!-- end layout wrapper -->

<?php }
?>