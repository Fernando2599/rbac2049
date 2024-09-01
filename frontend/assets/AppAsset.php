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
    public $sourcePath = '@frontend/themes/main';
    public $css = [

        'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,70',
        ' ./assets/css/nucleo-icons.css',
        './assets/css/nucleo-svg.css',

        './assets/css/nucleo-svg.css',
        './assets/css/soft-design-system.css?v=1.0.5',
    ];
    public $js = [
        ' https://kit.fontawesome.com/42d5adcbca.js',
        './assets/js/core/popper.min.js',
        './assets/js/core/bootstrap.min.js',
        './assets/js/plugins/perfect-scrollbar.min.js',
        './assets/js/plugins/countup.min.js',
        ' ./assets/js/plugins/choices.min.js',
        './assets/js/plugins/prism.min.js',
        './assets/js/plugins/highlight.min.js',
        './assets/js/plugins/rellax.min.js',
        './assets/js/plugins/tilt.min.js',
        './assets/js/plugins/choices.min.js',
        './assets/js/plugins/parallax.min.js',
        ' https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI',
        ' ./assets/js/soft-design-system.min.js?v=1.0.5'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
