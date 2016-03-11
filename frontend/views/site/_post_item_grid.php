<?php
use common\helpers\TextHelper;
use yii\bootstrap\Html;
use yii\helpers\Url;

$images = \frontend\models\PostImage::findAll(['post' => $item->id]);

    if(sizeof($item->photos) > 1){
        $secondImage = $item->photos[1]->link;
    }

?>

<a class="ad-image" href="<?=\yii\helpers\Url::toRoute(['post/'.$item->id])?>">
    <img class="add-box-main-image" src="<?=$item->photo?>"/>
    <img class="add-box-second-image" src="<?=isset($secondImage) ? $secondImage : $item->photo?>"/>
</a>
<div class="ad-box-content">
    <?=Html::a(TextHelper::limit_text($item->title, 37), Url::toRoute(['post/'.$item->id]))?>
    <div class="add-price">
        <?=Html::tag('span', $item->price)?>
    </div>
</div>