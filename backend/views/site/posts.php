<?php
use kartik\grid\GridView;
//use rmrevin\yii\fontawesome\FA;
use rmrevin\yii\fontawesome\FontAwesome as FA;
use yii\helpers\Html;

$js = <<<'SCRIPT'
var moderatePost = function(post){
    $.ajax({
        url: '/moderatepost',
        method: "POST",
        dataType : "json",
        data: {
            'post': post
        },
        success: function (data, textStatus) {

        }
    });
};
SCRIPT;

$this->registerJs($js, 1);
?>
<h1>Посты</h1>
<?=GridView::widget([
    'dataProvider'  =>  $dataProvider,
    'rowOptions'    =>  function($model){
        if($model->deleted == 1){
            return [
                'class' =>  'danger'
            ];
        }

        if($model->show == 0){
            return [
                'class' =>  'warning'
            ];
        }

        return [];
    },
    'columns'       =>  [
        [
            'attribute' =>  'id'
        ],
        [
            'attribute' =>  'title'
        ],
        [
            'attribute' =>  'category'
        ],
        [
            'attribute' =>  'premium',
            'value'     =>  function($model){
                return $model->premium != '0000-00-00 00:00:00' ? $model->premium : 'нет';
            }
        ],
        [
            'attribute' =>  'author'
        ],
        [
            'attribute' =>  'views'
        ],
        [
            'class'     =>  \kartik\grid\ActionColumn::className(),
            'width'     =>  '100px;',
            'buttons'   =>  [
                'view'  =>  function($url, $model){
                    return Html::a(FA::icon('file-text-o'), \yii\helpers\Url::toRoute(['viewpost/'.$model->id]), [
                        'class' =>  'btn btn-default'
                    ]);
                },
                'update'  =>  function($url, $model){
                    return Html::a(FA::icon($model->show == 1 ? 'eye' : 'eye-slash'), '#', [
                        'onclick'   =>  'moderatePost('.$model->id.'); return false;',
                        'class' =>  'btn btn-default'
                    ]);
                },
                'delete'  =>  function($url, $model){
                    return Html::a(FA::icon($model->show == 1 ? 'eye' : 'eye-slash'), '#', [
                        'class' =>  'btn btn-default'
                    ]);
                }
            ],
            'template'  =>  '<div class="btn-group btn-group-sm">{view}{update}{delete}</div>'
        ],
    ]
]);