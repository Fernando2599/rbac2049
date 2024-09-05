<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //public $sourcePath = '@vendor/myAssets';
    public $css = [
        'administrador/libs/jsvectormap/css/jsvectormap.min.css',
        'administrador/css/bootstrap.min.css',
        'administrador/libs/swiper/swiper-bundle.min.css',
        'administrador/css/icons.min.css',
        'administrador/css/app.min.css',
        'administrador/css/custom.min.css',
    ];
    public $js = [
        //'admin/js/layout.js',
        'administrador/libs/node-waves/waves.min.js',
        'administrador/libs/bootstrap/js/bootstrap.bundle.min.js',
        'administrador/libs/simplebar/simplebar.min.js',
        'administrador/libs/node-waves/waves.min.js',
        'administrador/libs/feather-icons/feather.min.js',
        'administrador/js/pages/plugins/lord-icon-2.1.0.js',
        'administrador/js/plugins.js',
        'administrador/libs/apexcharts/apexcharts.min.js',
        'administrador/js/pages/dashboard-projects.init.js',
        'administrador/libs/jsvectormap/js/jsvectormap.min.js',
        'administrador/libs/jsvectormap/maps/world-merc.js',
        'administrador/libs/swiper/swiper-bundle.min.js',
        'administrador/libs/flatpickr/flatpickr.min.js',
        'administrador/js/pages/dashboard-projects.init.js',
        'administrador/js/app.js',
        'administrador/libs/particles.js/particles.js',
        'administrador/js/pages/particles.app.js',
        'administrador/js/pages/password-addon.init.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap5\BootstrapAsset',
    ];
}
