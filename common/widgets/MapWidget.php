<?php

namespace common\widgets;

use frontend\assets\MapAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

class MapWidget extends \yii\base\Widget
{

    public $mapDiv = 'flatads-main-map';
    public $mapOptions = [];
    public $markers = [];
    public $markersOptions = [];
    public $maximumRange = 1000;
    public $height = 500;
    public $markersCluster = [];
    public $events = [];

    private $mapDefaultOptions = [
        'draggable' => true,
        'mapTypeControl' => true,
        'mapTypeId' => 'google.maps.MapTypeId.ROADMAP',
        'scrollwheel' => false,
        'panControl' => true,
        'rotateControl' => false,
        'scaleControl' => true,
        'streetViewControl' => true,
        'zoomControl' => true
    ];

    private $markersClusterDefault = [
        'radius'    =>  '20',
        '0'         =>  [
            'content'   =>  '<div class="cluster cluster-1">CLUSTER_COUNT</div>',
            'width'     =>  '62',
            'height'    =>  '62'
        ],
        '20'         =>  [
            'content'   =>  '<div class="cluster cluster-2">CLUSTER_COUNT</div>',
            'width'     =>  '82',
            'height'    =>  '82'
        ],
        '50'         =>  [
            'content'   =>  '<div class="cluster cluster-3">CLUSTER_COUNT</div>',
            'width'     =>  '102',
            'height'    =>  '102'
        ],
        'events'         =>  [

        ],

    ];

    private $markersOptionsDefault = [
        'draggable' =>  false
    ];

    public function init()
    {
        $this->mapOptions = array_merge($this->mapDefaultOptions, $this->mapOptions);

        $this->mapOptions['mapTypeId']  =   new JsExpression($this->mapOptions['mapTypeId']);

        $this->markersCluster = array_merge($this->markersClusterDefault, $this->markersCluster);
        if(empty($this->markersCluster['events']) || !isset($this->markersCluster['events']['click'])){
            $this->markersCluster['events']['click'] = new JsExpression('function(cluster) {
                            map.panTo(cluster.main.getPosition());
                            map.setZoom(map.getZoom() + 2);
                        }');
        }
        if(!isset($this->events['click']) || empty($this->events['click'])){
            $this->events['click']  =  new JsExpression('function(marker, event, context){
                            map.panTo(marker.getPosition());

                            var ibOptions = {
                                pixelOffset: new google.maps.Size(-125, -88),
                                alignBottom: true
                            };

                            infobox.setOptions(ibOptions);

                            infobox.setContent(context.data);
                            infobox.open(map,marker);

                            var iWidth = 260;
                            var iHeight = 300;
                            if((mapDiv.width() / 2) < iWidth ){
                                var offsetX = iWidth - (mapDiv.width() / 2);
                                map.panBy(offsetX,0);
                            }
                            if((mapDiv.height() / 2) < iHeight ){
                                var offsetY = -(iHeight - (mapDiv.height() / 2));
                                map.panBy(0,offsetY);
                            }
                        }');
        }

        $this->markersOptions = array_merge($this->markersOptionsDefault, $this->markersOptions);
    }

    public function getMarkers()
    {
        $markers = [];

        if (!empty($this->markers)) {
            foreach ($this->markers as $marker) {
                if ((isset($marker['latitude']) && !empty($marker['latitude'])) && (isset($marker['longitude']) && !empty($marker['longitude']))) {
                    $markerArray = [
                        'latLng' => [
                            $marker['latitude'], $marker['longitude']
                        ],
                        'options' => [
                            'shadow' => '/images/shadow.png'
                        ],
                        'data' => ''
                    ];

                    if (isset($marker['icon'])) {
                        $markerArray['options']['icon'] = $marker['icon'];
                    }

                    $markerArray['data'] = $this->getMarkerData($marker);

                    $markers[] = $markerArray;
                }
            }
        }

        return $markers;
    }

    public function getMarkerData($marker)
    {
        $markerInfoPrice = Html::tag('div', $marker->price, [
            'class' => 'marker-info-price'
        ]);
        $markerInfoLink = Html::tag('div', Html::a(\Yii::t('site', 'Подробнее'), $marker->link), [
            'class' => 'marker-info-link'
        ]);

        $markerInfoTitle = Html::tag('div', $marker->title, [
            'class' => 'marker-info-title'
        ]);

        $markerInfoExtra = Html::tag('div', $markerInfoPrice . $markerInfoLink, [
            'class' => 'marker-info-extra'
        ]);

        $markerInfoHolder = Html::tag('div', Html::tag('div', $markerInfoTitle . $markerInfoExtra, [
            'class' => 'marker-info'
        ]), [
            'class' => 'marker-info-holder'
        ]);

        $markerImage = Html::tag('div', Html::img($marker->image), [
            'class' => 'marker-image'
        ]);

        return Html::tag('div', Html::tag('div', $markerImage . $markerInfoHolder . Html::tag('div', '', ['class' => 'arrow-down']) . Html::tag('div', '', ['class' => 'close']), [
            'class' => 'marker-content'
        ]), [
            'class' => 'marker-holder'
        ]);
    }

    public function run()
    {
        $widget = '';

        $widget .= Html::tag('div', '', [
            'id' => $this->mapDiv
        ]);

        $options = [
            'map'   =>  [
                'options'   =>  $this->mapOptions
            ],
            'marker'    =>  [
                'options'   =>  $this->markersOptions,
                'cluster'   =>  $this->markersCluster
            ]
        ];

        $markers = $this->getMarkers();

        if(!empty($markers)){
            $options['marker'] = [
                'values'    =>  $markers,
            ];
        }

        if(!empty($this->events)){
            $options['marker']['events']  =   $this->events;
        }

        MapAsset::register($this->getVIew());

        $this->getView()->registerJs('mapDiv = $("#' . $this->mapDiv . '");');
        $this->getView()->registerJs('mapDiv.height('.$this->height.').gmap3('.Json::encode($options).', "autofit");');

        $js = <<<'SCRIPT'
            map = mapDiv.gmap3("get");
            infobox = new InfoBox({
                pixelOffset: new google.maps.Size(-50, -65),
                closeBoxURL: '',
                enableEventPropagation: true
            });
            mapDiv.delegate('.infoBox .close','click',function () {
                infobox.close();
            });

            if (Modernizr.touch){
                map.setOptions({ draggable : false });
                var draggableClass = 'inactive';
                var draggableTitle = "Activate map";
                var draggableButton = $('<div class="draggable-toggle-button ' + draggableClass + '">' + draggableTitle + '</div>').appendTo(mapDiv);
                draggableButton.click(function () {
                    if($(this).hasClass('active')){
                        $(this).removeClass('active').addClass('inactive').text("Activate map");
                        map.setOptions({ draggable : false });
                    } else {
                        $(this).removeClass('inactive').addClass('active').text("Deactivate map");
                        map.setOptions({ draggable : true });
                    }
                });
            }
SCRIPT;

        $this->getView()->registerJs($js);
        $this->getView()->registerJs('$("#advance-search-slider").slider({
                range: "min",
                value: 500,
                min: 1,
                max: '.$this->maximumRange.',
                slide: function( event, ui ) {
                    $("#geo-radius").val(ui.value);
                    $("#geo-radius-search").val(ui.value);

                    $(".geo-location-switch").removeClass("off");
                    $(".geo-location-switch").addClass("on");
                    $("#geo-location").val("on");

                    mapDiv.gmap3({
                        getgeoloc:{
                            callback : function(latLng){
                                if (latLng){
                                    $("#geo-search-lat").val(latLng.lat());
                                    $("#geo-search-lng").val(latLng.lng());
                                }
                            }
                        }
                    });
                }
});');

        $this->getView()->registerJs('$("#geo-radius").val( jQuery("#advance-search-slider").slider("value"));
            $("#geo-radius-search" ).val($("#advance-search-slider").slider("value"));

            $(".geo-location-button .fa").click(function(){

            if($(".geo-location-switch").hasClass("off")){
                $(".geo-location-switch" ).removeClass("off");
                $(".geo-location-switch" ).addClass("on");
                $("#geo-location" ).val("on");

                mapDiv.gmap3({
                    getgeoloc:{
                        callback : function(latLng){
                            if (latLng){
                                $("#geo-search-lat").val(latLng.lat());
                                $("#geo-search-lng").val(latLng.lng());
                            }
                        }
                    }
                });
            } else {
                $(".geo-location-switch").removeClass("on");
                $(".geo-location-switch").addClass("off");
                $("#geo-location").val("off");
            }
        });');

        $widget .= '<div id="advanced-search-widget-version2">
        <div class="container">
            <div class="advanced-search-widget-content">
                <form action="/" method="get" id="views-exposed-form-search-view-other-ads-page" accept-charset="UTF-8">
                    <div id="edit-search-api-views-fulltext-wrapper" class="views-exposed-widget views-widget-filter-search_api_views_fulltext">
                        <div class="views-widget">
                            <div class="control-group form-type-textfield form-item-search-api-views-fulltext form-item">
                                <div class="controls">
                                    <input placeholder="'.\Yii::t('site', 'Ключевые слова...').'" type="text" id="edit-search-api-views-fulltext" name="s" value="" size="30" maxlength="128" class="form-text">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="edit-ad-location-wrapper" class="views-exposed-widget views-widget-filter-field_ad_location">
                        <div class="views-widget">
                            <div class="control-group form-type-select form-item-ad-location form-item">
                                <div class="controls">
                                    <select id="edit-ad-location" name="post_location" class="form-select" style="display: none;">
                                        <option value="All" selected="selected">'.\Yii::t('site', 'Местоположение...').'</option>
                                        '.implode('', []).'
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="edit-field-category-wrapper" class="views-exposed-widget views-widget-filter-field_category">
                        <div class="views-widget">
                            <div class="control-group form-type-select form-item-field-category form-item">
                                <div class="controls">
                                    <select id="edit-field-category" name="category_name" class="form-select" style="display: none;">
                                        <option value="All" selected="selected">'.\Yii::t('site', 'Категория...').'</option>
                                        '.implode('', []).'
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="advanced-search-slider">
                        <div class="geo-location-button">
                            <div class="geo-location-switch off"><i class="fa fa-location-arrow"></i></div>
                        </div>

                        <div id="advance-search-slider" class="value-slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
                            <a class="ui-slider-handle ui-state-default ui-corner-all" href="#">
								<span class="range-pin">
									<input type="text" name="geo-radius" id="geo-radius" value="100" data-default-value="100">
								</span>
                            </a>
                        </div>

                    </div>

                    <input type="text" name="geo-location" id="geo-location" value="off" data-default-value="off">
                    <input type="text" name="geo-radius-search" id="geo-radius-search" value="500" data-default-value="500">
                    <input type="text" name="geo-search-lat" id="geo-search-lat" value="0" data-default-value="0">
                    <input type="text" name="geo-search-lng" id="geo-search-lng" value="0" data-default-value="0">


                    <div class="views-exposed-widget views-submit-button">
                        <button class="btn btn-primary form-submit" id="edit-submit-search-view" name="" value="Search" type="submit">'.\Yii::t('site', 'Поиск').'</button>
                    </div>
                </form>
            </div>
        </div>
    </div>';

        return Html::tag('section', $widget, [
            'id' => 'big-map'
        ]);
    }

}

?>