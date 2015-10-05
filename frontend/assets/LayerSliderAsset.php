<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 05.10.15
 * Time: 14:29
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class LayerSliderAsset extends AssetBundle{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        '/js/layerslider.kreaturamedia.jquery.js',
        '/js/greensock.js',
        '/js/layerslider.transitions.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}