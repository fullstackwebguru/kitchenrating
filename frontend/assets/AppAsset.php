<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/prettyPhoto.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/owl.transitions.css',
        'css/font-awesome.min.css',
        'css/chosen.min.css',
        'css/main.css',
        'css/responsive.css',
    ];
    public $js = [
        'js/jquery.elevatezoom.js',
        'js/jquery.malihu.PageScroll2id.js',
        'js/jquery.prettyPhoto.js',
        'js/owl.carousel.min.js',
        'js/chosen.jquery.min.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\jui\JuiAsset',
        'rmrevin\yii\fontawesome\AssetBundle'
    ];
}
