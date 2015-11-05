<?php
use kartik\grid\GridView;
use yii\helpers\Html;


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
            'buttons'   =>  [
                'view'  =>  function($url, $model){
                    return Html::a(\rmrevin\yii\fontawesome\FA::icon('file-text-o'), \yii\helpers\Url::toRoute(['viewpost/'.$model->id]));
                },
                'update'  =>  function($url, $model){
                    return Html::a(\rmrevin\yii\fontawesome\FA::icon($model->show == 1 ? 'eye' : 'eye-slash'), '#', [
                        'onclick'   =>  'moderatePost('.$model->id.'); return false;'
                    ]);
                },
                'delete'  =>  function($url, $model){
                    return Html::a('s');
                }
            ],
            'template'  =>  '{view}{update}{delete}'
        ],
    ]
]);