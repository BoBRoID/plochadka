<?php

return [
    'enablePrettyUrl'   =>  true,
    'showScriptName'    =>  false,
    'rules'             =>  [
        ''                  =>  'site/index',
        'gii'               =>  'gii/index',
        'gii/<action>'      =>  'gii/<action>',
        '<action:(createpost)>'          =>  'site/<action>'
    ]
];