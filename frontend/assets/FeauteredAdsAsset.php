<?php
/**
 * Created by PhpStorm.
 * User: ngilk
 * Date: 19.10.2015
 * Time: 21:14
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class FeauteredAdsAsset extends AssetBundle{

    public $css = [
        '/css/bootstrap-responsive.css'
    ];

    public $js = [
        '/js/jquery.carouFredSel-6.2.1-packed.js',
        'http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
} 