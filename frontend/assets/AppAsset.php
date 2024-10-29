<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    // public $basePath = '@webroot';
    //public $baseUrl = '@web';
        // Usa el sourcePath para copiar los archivos del backend
        public $sourcePath = '@backend/web/theme';

        public $css = [
            'libs/jsvectormap/css/jsvectormap.min.css',
            'css/bootstrap.min.css',
            'libs/swiper/swiper-bundle.min.css',
            'css/icons.min.css',
            'css/app.min.css',
            'css/custom.min.css',
        ];
    
        public $js = [
            'libs/node-waves/waves.min.js',
            'libs/bootstrap/js/bootstrap.bundle.min.js',
            'libs/simplebar/simplebar.min.js',
            'libs/feather-icons/feather.min.js',
            'js/pages/plugins/lord-icon-2.1.0.js',
            'js/plugins.js',
            'libs/apexcharts/apexcharts.min.js',
            'js/pages/dashboard-projects.init.js',
            'libs/jsvectormap/js/jsvectormap.min.js',
            'libs/jsvectormap/maps/world-merc.js',
            'libs/swiper/swiper-bundle.min.js',
            'libs/flatpickr/flatpickr.min.js',
            'js/app.js',
            'libs/particles.js/particles.js',
            'js/pages/particles.app.js',
            'js/pages/password-addon.init.js',
            'libs/swiper/swiper-bundle.min.js',
            'js/pages/job-lading.init.js',
        ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap5\BootstrapAsset',
    ];
}
