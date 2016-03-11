<?php
$current = -1;
?>
<div class="pane popular-ads-grid-holder">
    <div class="popular-ads-grid">
        <?=\yii\widgets\ListView::widget([
            'dataProvider'  =>  new \yii\data\ActiveDataProvider([
                'query' =>  \common\models\Post::find()->orderBy('views DESC'),
                'pagination'    =>  [
                    'pageSize'  =>  9
                ]
            ]),
            'itemOptions'   =>  [
                'class' =>  'ad-box col-xs-3 random-posts-grid'.($current%3 == 0 ? ' first' : '')
            ],
            'itemView'  =>  function($model) use (&$current){
                $current++;

                return $this->render('_post_item_grid', [
                    'item'      =>  $model,
                    'current'   =>  $current
                ]);
            },
            'summary'   =>  '',
        ])?>
    </div>
</div>