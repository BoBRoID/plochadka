<?php

return [
    'enablePrettyUrl'   =>  true,
    'showScriptName'    =>  false,
    'rules'             =>  [
        ''              =>  'site/index',
        '<action>'      =>  'site/<action>',
        'viewpost/<id>' =>  'site/viewpost'
    ]
];