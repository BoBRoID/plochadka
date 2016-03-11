<?php
use yii\bootstrap\Html;
use yii\helpers\Url;

echo Html::a(Html::img($post->photo), Url::to('/post/'.$post->id), ['class' => 'ad-image']).
    Html::tag('div', Html::tag('span',
            Html::tag('div', \rmrevin\yii\fontawesome\FA::icon($post->categoryObject->image), [
                'style' =>  'background-color: '.$post->categoryObject->color,
                'class' =>  'category-icon-box'
            ]), ['class' => 'ad-category']).
        Html::a($post->title, Url::to('/post/'.$post->id)).
        Html::tag('div', Html::tag('span', $post->price), ['class' => 'add-price']), ['class' => 'ad-box-content']);