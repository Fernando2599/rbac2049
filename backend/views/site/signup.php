<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \backend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Registro';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
    '@web/theme/functionAjax/loginAjax.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
)
?>

<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>


<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">

            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>

        </div>

        <!-- auth page content -->
        <div class="auth-page-content">

            <div class="container">

                <div class="row">

                    <div class="col-lg-12">

                        <div class="text-center mt-sm-5 mb-4 text-white-50">

                            <div>
                                <a href="index.php" class="d-inline-block auth-logo">
                                    <img src="assets/images/logo-light.png" alt="" height="20">
                                </a>
                            </div>

                            <p class="mt-3 fs-15 fw-medium">Sistema modelo dual</p>

                        </div>

                    </div>

                </div>
                <!-- end row -->

                <div class="row justify-content-center">

                    <div class="col-md-8 col-lg-6 col-xl-5">

                        <div class="card mt-4">

                            <div class="card-body p-4">

                                <div class="text-center mt-2">

                                    <h5 class="text-primary">Crea una nueva cuenta</h5>
                                    <p class="text-muted">Complete los siguientes campos para registrarte.</p>

                                </div>

                                <div class="p-2 mt-4">

                                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                                    <form>


                                        <?= $form->field($model, 'username')->textInput([
                                            'autofocus' => true,
                                            'class' => 'form-control'
                                        ])->label('Usuario'); ?>

                                </div>

                                <div class="p-2 mt-4">

                                    <?= $form->field($model, 'email')->textInput(['class' => 'form-control']) ?>

                                </div>

                                <div class="float-end">

                                    <a href="auth-pass-reset-basic.php" class="text-muted">Forgot password?</a>

                                </div>

                                <div class="position-relative mb-3 px-2">

                                    <?= $form->field($model, 'password', [
                                        'template' => '{label}<div class="input-group">{input}<button class="btn btn-link text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-line"></i></button></div>{error}',
                                        'options' => ['class' => 'form-group'],
                                    ])->passwordInput([
                                        'class' => 'form-control',
                                        'id' => 'password-input',
                                        'placeholder' => 'Enter password',
                                    ]) ?>
                                </div>

                                <div class="mt-4 p-2">
                                    <?= Html::submitButton('Registrarse', ['class' => 'btn btn-success w-100', 'name' => 'signup-button']) ?>
                                </div>

                            </div>

                            </form>

                            <?php ActiveForm::end(); ?>

                        </div>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="mt-4 text-center">
                    <p class="mb-0">¿ Ya tiene una cuenta ? <?= Html::a('Iniciar Sesion', ['site/login'], ['class' => 'fw-semibold text-primary text-decoration-underline']) ?></p>
                </div>

            </div>

        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</body>