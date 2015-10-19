<?php

return [
    'enablePrettyUrl'   =>  true,
    'showScriptName'    =>  false,
    'rules'             =>  [
        ''                  =>  'site/index',
        '<action:(login|logout|register|accont|createpost)>'          =>  'site/<action>',
        '<url:(.*)>'    =>  'site/renderpage'
    ]
];