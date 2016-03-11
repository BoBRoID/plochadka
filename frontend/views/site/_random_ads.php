<?php
$current = -1;
?>
<div class="pane random-ads-grid-holder">
    <div class="random-ads-grid">
        <?=\yii\widgets\ListView::widget([
            'dataProvider'  =>  new \yii\data\ActiveDataProvider([
                'query' =>  \common\models\Post::find()->orderBy('RAND()'),
                'pagination'    =>  [
                    'pageSize'  =>  9
                ]
            ]),
            'itemOptions'   =>  [
                'class' =>  'ad-box col-xs-3 random-posts-grid'.($current%3 == 0 ? ' first' : '')
            ],
            'summary'   =>  '',
            'itemView'  =>  function($model) use (&$current){
                $current++;

                return $this->render('_post_item_grid', [
                    'item'      =>  $model,
                    'current'   =>  $current
                ]);
            }
        ])?>
    </div>
</div>