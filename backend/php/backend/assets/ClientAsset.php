<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ClientAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/client.css',
    ];
    public $js = [
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
