<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 05.10.15
 * Time: 14:29
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class MapAsset extends AssetBundle{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'https://maps.googleapis.com/maps/api/js?v=3.exp&#038;sensor=false&#038;ver=2013-07-18',
        '/js/gmap3.min.js',
        '/js/gmap3.infobox.js',
        '/js/modernizr.touch.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'frontend\assets\LayerSliderAsset'
    ];
}