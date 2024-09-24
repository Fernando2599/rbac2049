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

    <!-- Begin page -->
    <div class="layout-wrapper landing">

        <nav class="navbar navbar-expand-lg navbar-landing fixed-top job-navbar" id="navbar">
            <div class="container-fluid custom-container">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/images/logo-dark.png" class="card-logo card-logo-dark" alt="logo dark" height="17">
                    <img src="assets/images/logo-light.png" class="card-logo card-logo-light" alt="logo light" height="17">
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
                            . '<i class="ri-user-3-line align-bottom me-1"></i> Login & Register'
                            . '</a>'
                            . '</div>';
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
                            <h1 class="display-6 fw-bold text-capitalize mb-3 lh-base">Find your next job and build your dream here</h1>
                            <p class="lead text-muted lh-base mb-4">Find jobs, create trackable resumes and enrich your applications. Carefully crafted after analyzing the needs of different industries.</p>
                            <form action="#" class="job-panel-filter">
                                <div class="row g-md-0 g-2">
                                    <div class="col-md-4">
                                        <div>
                                            <input type="search" id="job-title" class="form-control filter-input-box" placeholder="Job, Company name...">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-4">
                                        <div>
                                            <select class="form-control" data-choices>
                                                <option value="">Select job type</option>
                                                <option value="Full Time">Full Time</option>
                                                <option value="Part Time">Part Time</option>
                                                <option value="Freelance">Freelance</option>
                                                <option value="Internship">Internship</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-4">
                                        <div class="h-100">
                                            <button class="btn btn-primary submit-btn w-100 h-100" type="submit"><i class="ri-search-2-line align-bottom me-1"></i> Find Job</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>

                            <ul class="treding-keywords list-inline mb-0 mt-3 fs-13">
                                <li class="list-inline-item text-danger fw-semibold"><i class="mdi mdi-tag-multiple-outline align-middle"></i> Trending Keywords:</li>
                                <li class="list-inline-item"><a href="javascript:void(0)">Design,</a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)">Development,</a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)">Manager,</a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)">Senior</a></li>
                            </ul>
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
                                    <h5 class="fs-15 lh-base mb-0">Work Inquiry from velzon</h5>
                                </div>
                            </div>

                            <div class="card p-3 rounded shadow-lg application-box">
                                <h5 class="fs-15 lh-base mb-3">Applications</h5>
                                <div class="avatar-group">
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Brent Gonzalez">
                                        <div class="avatar-xs">
                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle img-fluid">
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Ellen Smith">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-danger">
                                                S
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Ellen Smith">
                                        <div class="avatar-xs">
                                            <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle img-fluid">
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-success">
                                                Z
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Brent Gonzalez">
                                        <div class="avatar-xs">
                                            <img src="assets/images/users/avatar-9.jpg" alt="" class="rounded-circle img-fluid">
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="More Appliances">
                                        <div class="avatar-xs">
                                            <div class="avatar-title fs-13 rounded-circle bg-light border-dashed border text-primary">
                                                2k+
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <img src="assets/images/job-profile2.png" alt="" class="user-img">

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
                            <div class="card rounded shadow-lg inquiry-box d-none d-lg-block">
                                <div class="card-body d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0 me-3">
                                        <div class="avatar-title bg-secondary-subtle text-secondary rounded-circle fs-18">
                                            <i class="ri-briefcase-2-line"></i>
                                        </div>
                                    </div>
                                    <h5 class="fs-15 lh-base mb-0">Search Over <span class="text-secondary fw-semibold">1,00,000+</span> Jobs</h5>
                                </div>
                            </div>

                            <div class="card feedback-box">
                                <div class="card-body d-flex shadow-lg">
                                    <div class="flex-shrink-0 me-3">
                                        <img src="assets/images/users/avatar-10.jpg" alt="" class="avatar-sm rounded-circle">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fs-14 lh-base mb-0">Tonya Noble</h5>
                                        <p class="text-muted fs-11 mb-1">UI/UX Designer</p>

                                        <div class="text-warning">
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-fill"></i>
                                            <i class="ri-star-s-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="assets/images/about.jpg" alt="" class="img-fluid mx-auto rounded-3" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-muted">
                            <h1 class="mb-3 lh-base">Find Your <span class="text-primary">Dream Job</span> in One Place</h1>
                            <p class="ff-secondary fs-16 mb-2">The first step in finding your <b>dream job </b> is deciding where to look for first-hand insight. Contact professionals who are already working in industries or positions that interest you.</p>
                            <p class="ff-secondary fs-16">Schedule informational interviews and phone calls or ask for the opportunity to shadow them on the job.</p>

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
                                        <p class="mb-0">Dynamic Content</p>
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
                                        <p class="mb-0">Setup plugin's information.</p>
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
                                        <p class="mb-0">Themes customization information</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <a href="#!" class="btn btn-primary">Find Your Jobs <i class="ri-arrow-right-line align-bottom ms-1"></i></a>
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
                            <h1 class="mb-3 fw-semibold lh-base">How <span class="text-primary">it's work</span> creative jobs & quickly features</h1>
                            <p class="text-muted">A creative person has the ability to invent and develop original ideas, especially in the arts. Like so many creative people, he was never satisfied.</p>
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
                                <h6 class="fs-17 mb-2">Register Account</h6>
                                <p class="text-muted mb-0 fs-15">First, You need to make a account.</p>
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
                                <h6 class="fs-17 mb-2">Create Resume</h6>
                                <p class="text-muted mb-0 fs-15">Create a resume for your job.</p>
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

                                <h6 class="fs-17 mb-2">Find Job</h6>
                                <p class="text-muted mb-0 fs-15">Search for your dream jobs from velzon.</p>
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
                                <h6 class="fs-17 mb-2">Apply Job</h6>
                                <p class="text-muted mb-0 fs-15">Apply to the compnay and wait for interview.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end container-->
        </section>

        <!-- start services -->
        <section class="section bg-light" id="Experiencia">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h1 class="mb-3 fw-semibold text-capitalize lh-base">Hire Experts <span class="text-primary">Team</span></h1>
                            <p class="text-muted mb-4">Hiring experts costs more per hour than hiring entry- or mid-level freelancers, but they can usually get the work done faster—and better.</p>
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
                                            <img src="assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-md mx-auto d-block">
                                            <h5 class="fs-17 mt-3 mb-2">Nancy Martino</h5>
                                            <p class="text-muted fs-13 mb-3">Creative Designer</p>

                                            <p class="text-muted mb-4 fs-14">
                                                <i class="ri-map-pin-2-line text-primary me-1 align-bottom"></i> Escondido, California
                                            </p>

                                            <a href="#!" class="btn btn-primary w-100">View Profile</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card text-center">
                                        <div class="card-body p-4">
                                            <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-md mx-auto d-block">
                                            <h5 class="fs-17 mt-3 mb-2">Glen Matney</h5>
                                            <p class="text-muted fs-13 mb-3">Marketing Director</p>

                                            <p class="text-muted mb-4 fs-14">
                                                <i class="ri-map-pin-2-line text-primary me-1 align-bottom"></i> Escondido, California
                                            </p>

                                            <a href="#!" class="btn btn-primary w-100">View Profile</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card text-center">
                                        <div class="card-body p-4">
                                            <img src="assets/images/users/avatar-10.jpg" alt="" class="rounded-circle avatar-md mx-auto d-block">
                                            <h5 class="fs-17 mt-3 mb-2">Alexis Clarke</h5>
                                            <p class="text-muted fs-13 mb-3">Product Manager</p>

                                            <p class="text-muted mb-4 fs-14">
                                                <i class="ri-map-pin-2-line text-primary me-1 align-bottom"></i> Escondido, California
                                            </p>

                                            <a href="#!" class="btn btn-primary w-100">View Profile</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card text-center">
                                        <div class="card-body p-4">
                                            <img src="assets/images/users/avatar-8.jpg" alt="" class="rounded-circle avatar-md mx-auto d-block" />
                                            <h5 class="fs-17 mt-3 mb-2">James Price</h5>
                                            <p class="text-muted fs-13 mb-3">Product Designer</p>

                                            <p class="text-muted mb-4 fs-14">
                                                <i class="ri-map-pin-2-line text-primary me-1 align-bottom"></i> Escondido, California
                                            </p>

                                            <a href="#!" class="btn btn-primary w-100">View Profile</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card text-center">
                                        <div class="card-body p-4">
                                            <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-md mx-auto d-block" />
                                            <h5 class="fs-17 mt-3 mb-2">Michael Morris</h5>
                                            <p class="text-muted fs-13 mb-3">Full Stack Developer</p>

                                            <p class="text-muted mb-4 fs-14">
                                                <i class="ri-map-pin-2-line text-primary me-1 align-bottom"></i> Escondido, California
                                            </p>

                                            <a href="#!" class="btn btn-primary w-100">View Profile</a>
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

        <!-- start blog -->
        <section class="section" id="blog">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h1 class="mb-3 fw-semibold text-capitalize lh-base">Our Latest <span class="text-primary">News</span></h1>
                            <p class="text-muted mb-4">We thrive when coming up with innovative ideas but also understand that a smart concept should be supported with faucibus sapien odio measurable results.</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <img src="assets/images/small/img-8.jpg" alt="" class="img-fluid rounded" />
                            </div>
                            <div class="card-body">
                                <ul class="list-inline fs-14 text-muted">
                                    <li class="list-inline-item">
                                        <i class="ri-calendar-line align-bottom me-1"></i> 30 Oct, 2021
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ri-message-2-line align-bottom me-1"></i> 364 Comment
                                    </li>
                                </ul>
                                <a href="javascript:void(0);">
                                    <h5>Design your apps in your own way ?</h5>
                                </a>
                                <p class="text-muted fs-14">One disadvantage of Lorum Ipsum is that in Latin certain letters appear more frequently than others.</p>

                                <div>
                                    <a href="#!" class="link-success">Learn More <i class="ri-arrow-right-line align-bottom ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <img src="assets/images/small/img-6.jpg" alt="" class="img-fluid rounded" />
                            </div>
                            <div class="card-body">
                                <ul class="list-inline fs-14 text-muted">
                                    <li class="list-inline-item">
                                        <i class="ri-calendar-line align-bottom me-1"></i> 02 Oct, 2021
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ri-message-2-line align-bottom me-1"></i> 245 Comment
                                    </li>
                                </ul>
                                <a href="javascript:void(0);">
                                    <h5>Smartest Applications for Business ?</h5>
                                </a>
                                <p class="text-muted fs-14">Due to its widespread use as filler text for layouts, non-readability is of great importance: human perception.</p>

                                <div>
                                    <a href="#!" class="link-success">Learn More <i class="ri-arrow-right-line align-bottom ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <img src="assets/images/small/img-9.jpg" alt="" class="img-fluid rounded" />
                            </div>
                            <div class="card-body">
                                <ul class="list-inline fs-14 text-muted">
                                    <li class="list-inline-item">
                                        <i class="ri-calendar-line align-bottom me-1"></i> 23 Sept, 2021
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ri-message-2-line align-bottom me-1"></i> 354 Comment
                                    </li>
                                </ul>
                                <a href="javascript:void(0);">
                                    <h5>How apps is changing the IT world</h5>
                                </a>
                                <p class="text-muted fs-14">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate one-to-one technology.</p>

                                <div>
                                    <a href="#!" class="link-success">Learn More <i class="ri-arrow-right-line align-bottom ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end container -->
        </section>
        <!-- end blog -->

        <!-- start cta -->
        <section class="py-5 bg-primary position-relative">
            <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-sm">
                        <div>
                            <h4 class="text-white fw-semibold">Get New Jobs Notification!</h4>
                            <p class="text-white text-opacity-75 mb-0">Subscribe & get all related jobs notification.</p>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-sm-auto">
                        <button class="btn btn-danger" type="button">Subscribe Now <i class="ri-arrow-right-line align-bottom"></i></button>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end cta -->

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
                                <h5 class="text-white mb-0">Company</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a href="pages-profile.php">About Us</a></li>
                                        <li><a href="pages-gallery.php">Gallery</a></li>
                                        <li><a href="pages-team.php">Team</a></li>
                                        <li><a href="pages-pricing.php">Pricing</a></li>
                                        <li><a href="pages-timeline.php">Timeline</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">For Jobs</h5>
                                <div class="text-muted mt-3">
                                    <ul class="list-unstyled ff-secondary footer-list">
                                        <li><a href="apps-job-lists.php">Job List</a></li>
                                        <li><a href="apps-job-application.php">application</a></li>
                                        <li><a href="apps-job-new.php">New Job</a></li>
                                        <li><a href="apps-job-companies-lists.php">Company List</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-4">
                                <h5 class="text-white mb-0">Support</h5>
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

        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-info btn-icon landing-back-top" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

    </div>
    <!-- end layout wrapper -->

<?php }
?>