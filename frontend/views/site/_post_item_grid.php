<?php
    $images = \app\models\PostImage::findAll(['post' => $item->id]);

    if(sizeof($images) > 1){
        $secondImage = $images[1]->link;
    }

    $firstImage = $images[0]->link;

?>

<a class="ad-image" href="<?=\yii\helpers\Url::toRoute(['post/'.$item->id])?>">
    <img class="add-box-main-image" src="<?=$firstImage?>"/>
    <img class="add-box-second-image" src="<?=isset($secondImage) ? $secondImage : $firstImage?>"/>
</a>
<div class="ad-box-content">
    <a href="<?=\yii\helpers\Url::toRoute(['post/'.$item->id])?>"><?=\common\helpers\TextHelper::limit_text($item->title, 37)?></a>
    <div class="add-price">
        <span><?=$item->price?></span>
    </div>
</div>