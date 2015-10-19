<?php
/**
 * Created by PhpStorm.
 * User: ngilk
 * Date: 19.10.2015
 * Time: 21:12
 */

namespace frontend\widgets;


use frontend\assets\FeauteredAdsAsset;
use yii\base\Widget;

class FeauteredAds extends Widget{

    public $items = [];

    public function init(){

    }

    public function run(){
        FeauteredAdsAsset::register($this->getView());
        $this->getView()->registerJs("$('#projects-carousel').carouFredSel({
                                auto: false,
                                prev: '#carousel-prev',
                                next: '#carousel-next',
                                pagination: \"#carousel-pagination\",
                                mousewheel: true,
                                swipe: {
                        onMouse: true,
                                    onTouch: true
                                }
                            });");
    }

    private function renderBlock($model){

    }

} 