<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="dark" data-sidebar-size="lg" data-sidebar="dark" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= $this->render('partials/head-css') ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?= $this->render('partials/menu') ?>

    <!-- Start right Content here -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <?= $content ?>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?= $this->render('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?= $this->render('partials/customizer') ?>
<?= $this->render('partials/vendor-scripts') ?>
<!-- App js -->
<script src="<?= Url::base(true) ?>/administrador/libs/flatpickr/flatpickr.min.js"></script>
<script src="<?= Url::base(true) ?>/administrador/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= Url::base(true) ?>/administrador/js/app.js"></script>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
