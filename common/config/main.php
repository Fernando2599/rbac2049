<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManagerFrontEnd' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => 'https://modelodual.valladolid.tecnm.mx',  // Cambia por el dominio de tu frontend
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ]
    
];
