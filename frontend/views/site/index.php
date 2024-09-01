<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Sistema Dual';

use yii\helpers\Url;

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
if (Yii::$app->user->can('estudiante')) { ?>

    <div class="site-index">

        <h1 style="text-align:center;" class="text-primary text-gradient mb-0">Gestor de expediente</h2>
            <br><br>

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


<?php } else { ?>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="row text-center my-sm-5 mt-5">
                    <div class="col-lg-6 mx-auto">
                        <h2 class="text-primary text-gradient mb-0">Aprovecha el</h2>
                        <h2 class="text-primary text-gradient mb-0">Modelo de Educación Dual</h2>
                        <p class="lead">Adquiere experiencia laboral y trabaja con una empresa desde ahora.<br /> </p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <div class="row mt-4">
                        <div class="col-md-6">

                            <div class="card move-on-hover">
                                <img class="w-100" src=<?php echo Url::to('@web/archivos/admin.png', true); ?> alt="">
                            </div>
                            <div class="mt-2 ms-2">
                                <a href="#">
                                    <h6 class="mb-0">Ing. en Administración</h6>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-6 mt-md-0 mt-5">
                            <div class="card move-on-hover">
                                <img class="w-100" src=<?php echo Url::to('@web/archivos/industrial.png', true); ?> alt="">
                            </div>
                            <div class="mt-2 ms-2">
                                <a href="#">
                                    <h6 class="mb-0">Ing. Industrial</h6>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-6 mt-md-0 mt-6">
                            <div class="card move-on-hover">
                                <img class="w-100" src=<?php echo Url::to('@web/archivos/sistemas.png', true); ?> alt="">
                            </div>
                            <div class="mt-2 ms-2">
                                <h6>
                                    Ing. en Sistemas Computacionales
                            </div>
                            </h6>
                        </div>

                        <div class="col-md-6 mt-md-0 mt-6">
                            <div class="card move-on-hover">
                                <img class="w-100" src=<?php echo Url::to('@web/archivos/ambiental.png', true); ?> alt="">
                            </div>
                            <div class="mt-2 ms-2">
                                <h6>
                                    Ing. Ambiental
                            </div>
                            </h6>
                        </div>

                        <div class="col-md-6 mt-md-0 mt-6">
                            <div class="card move-on-hover">
                                <img class="w-100" style="width:100%;;" src=<?php echo Url::to('@web/archivos/civil.jpg', true); ?> alt="">
                            </div>
                            <div class="mt-2 ms-2">
                                <h6>
                                    Ing. Civil
                                </h6>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-3 mx-auto mt-md-0 mt-5">
                    <div class="position-sticky" style="top:100px !important">
                        <h4 class="">Modelo de Eduación Dual</h4>
                        <h6 class="text-secondary">Éstas son solo una pequeña prueba de alumnos trabajando en una empresa!</h6>
                    </div>
                </div>
            </div>
    </section>

    <!-- -------   START PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
    <div class="pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 ms-auto">
                    <h4 class="mb-1">¡Gracias por tu visita!</h4>
                    <p class="lead mb-0">Encontrarás mas informacion en el Tecnologico Superior de Valladolid</p>
                </div>
                <div class="col-lg-5 me-lg-auto my-lg-auto text-lg-end mt-5">
                    <a href="https://twitter.com" class="btn btn-info mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/TecNMCampusValladolid" class="btn btn-primary mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1"></i> facebook
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php }
?>