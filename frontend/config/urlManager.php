<?php

return [
    'enablePrettyUrl'   =>  true,
    'showScriptName'    =>  false,
    'rules'             =>  [
        ''                  =>  'site/index',
        '<action:(login|logout|register|myaccount|createpost)>'          =>  'site/<action>',
        'account/<id>'          =>  'site/account',
        'post/<id>'             =>  'site/post',
        '<url:(.*)>'            =>  'site/renderpage'
    ]
];