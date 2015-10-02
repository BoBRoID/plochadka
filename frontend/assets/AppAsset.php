<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/layerslider.css',
        'http://fonts.googleapis.com/css?family=Lato:100,300,regular,700,900|Open+Sans:300|Indie+Flower:regular|Oswald:300,regular,700&#038;subset=latin,latin-ext',
        'css/bbpress.css',
        'css/facebook-btn.css',
        'css/woocommerce-layout.css',
        'css/woocommerce-smallscreen.css',
        'css/woocommerce.css',
        'css/postratings-css.css',
        'css/checkbox.min.css',
        'css/form.min.css',
        'css/buttons.min.css',
        'css/dashicons.min.css',
        'css/mediaelementplayer.min.css',
        'css/wp-mediaelement.css',
        'css/media-views.min.css',
        'css/imgareaselect.css',
        'http://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C700%2C300italic%2C400italic%2C700italic%7CBitter%3A400%2C700&#038;subset=latin%2Clatin-ext',
        'css/genericons.css',
        'css/style.css',
        'css/font-awesome.min.css',
        'css/chosen.min.css',
        'css/flexslider.css',
        'css/custom.css',
        'http://fonts.googleapis.com/css?family=Roboto%3A400%2C400italic%2C500%2C300%2C300italic%2C500italic%2C700%2C700italic&#038;ver=4.0.8',
        'http://fonts.googleapis.com/css?family=Armata&#038;ver=4.0.8',
    ];
    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
