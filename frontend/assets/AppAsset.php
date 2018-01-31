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
        'css/site.css',
        'css/fonts.css', // подключаем шрифты
        'css/site_addons.css',
        
        'ckeditor/plugins/codesnippet/lib/highlight/styles/rainbow.css',
        // и т.д.
    ];
    public $js = [
        'js/comment.js',
        'js/calendar.js',
        
        'ckeditor/config.js',
        'ckeditor/ckeditor.js',
        'ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js',

        'js/highlight_init.js',
        // и т.д.
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        // и т.д.
    ];
}
