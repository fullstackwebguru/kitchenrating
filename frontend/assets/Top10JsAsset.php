<?php

namespace frontend\assets;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class Top10JsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
    ];

    public $js = [
        'js/top10.js',
    ];
    
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
