<div class="list-featured-ads">
    <div class="list-feat-ad-image">
        <a class="ad-image" href="/">
            <img class="add-box-main-image" src="<?=$post->photo?>"/>
            <img class="add-box-second-image" src="<?=$post->photo?>"/>
        </a>
    </div>
    <div class="list-feat-ad-content">
        <div class="list-feat-ad-title">
            <a href="/"><?=(strlen($post->title) > 50) ? substr($post->title,0,47).'...' : $post->title?></a>
            <div class="add-price"><span><?=$post->price?></span></div>
        </div>
        <div class="list-feat-ad-excerpt">
            <p>
                <?=\common\helpers\TextHelper::limit_text($post->content, 20)?>
            </p>
        </div>
        <div class="read-more"><a href="/"><?=\Yii::t('site', 'Details')?></a></div>
    </div>
</div>