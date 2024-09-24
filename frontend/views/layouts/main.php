<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;


$asset = frontend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">
    <?php $this->beginBody() ?>

    <div class="layout-wrapper landing">

        <div class="">
            <?= $content ?>
        </div>
        </section>

        <!-- -------   END PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->

        <!-- Start footer -->
        <footer class="custom-footer bg-dark py-5 position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mt-4">
                        <div>
                            <div>
                                <img src="assets/images/logo-light.png" alt="logo light" height="17" />
                            </div>
                            <div class="mt-4 fs-15">
                                <p>Premium Multipurpose Admin & Dashboard Template</p>
                                <p>You can build any type of web application like eCommerce, CRM, CMS, Project management apps, Admin Panels, etc using Velzon.</p>
                                <ul class="list-inline mb-0 footer-social-link">
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="avatar-xs d-block">
                                            <div class="avatar-title rounded-circle">
                                                <i class="ri-facebook-fill"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="avatar-xs d-block">
                                            <div class="avatar-title rounded-circle">
                                                <i class="ri-github-fill"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="avatar-xs d-block">
                                            <div class="avatar-title rounded-circle">
                                                <i class="ri-linkedin-fill"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="avatar-xs d-block">
                                            <div class="avatar-title rounded-circle">
                                                <i class="ri-google-fill"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);" class="avatar-xs d-block">
                                            <div class="avatar-title rounded-circle">
                                                <i class="ri-dribbble-line"></i>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 ms-lg-auto">
                        <div class="row">
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">Información</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a href="#inicio">Inicio</a></li>
                                        <li><a href="#acerca">Acerca de</a></li>
                                        <li><a href="#proceso">Proceso</a></li>
                                        <li><a href="#experiencia">Experiencia</a></li>
                                        <li><a href="">Quiero ser dual</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-4">
                                <h5 class="text-white mb-0">Contacto</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a class="text-capitalize lh-base" href="apps-job-lists.php">Teléfono: <span class="text-primary">Demostraciones</span></a></li>
                                        <li><a class="text-capitalize lh-base" href="apps-job-application.php">Correo Electrónico: <span class="text-primary">Demostraciones</span></a></li>
                                        <li><a class="text-capitalize lh-base" href="apps-job-new.php">Dirección: <span class="text-primary">Demostraciones</span></a></li>
                                        <li><a class="text-capitalize lh-base" href="apps-job-companies-lists.php">Horario de Atención: <span class="text-primary">Demostraciones</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-2 mt-4">
                                <h5 class="text-white mb-0">Soporte</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a href="pages-faqs.php">FAQ</a></li>
                                        <li><a href="pages-faqs.php">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row text-center text-sm-start align-items-center mt-5">
                    <div class="col-sm-6">
                        <div>
                            <p class="copy-rights mb-0">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © Velzon - Themesbrand
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end mt-3 mt-sm-0">
                            <ul class="list-inline mb-0 footer-list gap-4 fs-15">
                                <li class="list-inline-item">
                                    <a href="pages-privacy-policy.php">Privacy Policy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="pages-term-conditions.php">Terms & Conditions</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="pages-privacy-policy.php">Security</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->
        
        <script type="text/javascript">
            if (document.getElementById('state1')) {
                const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
                if (!countUp.error) {
                    countUp.start();
                } else {
                    console.error(countUp.error);
                }
            }
            if (document.getElementById('state2')) {
                const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
                if (!countUp1.error) {
                    countUp1.start();
                } else {
                    console.error(countUp1.error);
                }
            }
            if (document.getElementById('state3')) {
                const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
                if (!countUp2.error) {
                    countUp2.start();
                } else {
                    console.error(countUp2.error);
                };
            }
        </script>
        <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
