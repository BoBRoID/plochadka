<?php

use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Html;

$subcategories = [];

echo Html::tag('div',
    Html::tag('div',
        Html::tag('span', (!empty($category->image) ? Html::tag('div', FA::i($category->image), [
            'class' =>  'category-icon-box',
            'style' =>  'background-color: '.$category->color
        ]) : ''), [
            'class' =>  'category-icon'
        ]).
        Html::tag('span', Html::a(Html::tag('h4', $category->name), $category->link), ['class' => 'cat-title']).
        Html::tag('span' , Html::tag('h4', $category->postsCount), ['class' => 'category-total']),
        [
            'class' => 'category-header'
        ]).
        Html::tag('div', Html::tag('ul', implode('', $subcategories)), ['class' => 'category-content']),
    [
        'class' =>  'category-box span3'.($current%4 == 0 ? ' first' : '')
    ]
);