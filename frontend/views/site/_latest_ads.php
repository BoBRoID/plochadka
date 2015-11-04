<?php
$current = 0;
?>
<div class="pane latest-ads-holder">
        <?=\yii\widgets\ListView::widget([
            'dataProvider'  =>  new \yii\data\ActiveDataProvider([
                'query' =>  \common\models\Post::find()->where(['category' => $category])->orderBy('created DESC'),
                'pagination'    =>  [
                    'pageSize'  =>  9
                ]
            ]),
            'itemView'  =>  function($model) use (&$current){
                $current++;

                return $this->render('_post_item_grid', [
                    'item'      =>  $model,
                    'current'   =>  $current
                ]);
            },
            'itemOptions'   =>  [
                'class' =>  'ad-box span3 latest-posts-grid'.($current%3 == 0 ? ' first' : '')
            ],
            'options'  =>  [
                'class' =>  'latest-ads-grid-holder'
            ],
            'summary'   =>  '',
        ])?>
</div>