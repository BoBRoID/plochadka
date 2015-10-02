<?php
namespace common\widgets;

class TopMenu extends \yii\bootstrap\Widget
{
    public $alertTypes = [
        'error'   => 'alert-danger',
        'danger'  => 'alert-danger',
        'success' => 'alert-success',
        'info'    => 'alert-info',
        'warning' => 'alert-warning'
    ];

    public $closeButton = [];

    public function init()
    {
        parent::init();

        
    }
}
