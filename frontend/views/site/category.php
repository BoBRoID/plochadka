<section id="category-featured-ads-title">
    <div class="container">
        <?php if(!empty($category->image)){ ?>
        <div class="category-icon-box" style="background-color: <?php echo $category_icon_color; ?>;"><?=$category->image?></div>
        <?php } ?>
        <h2><?=$category->name?></h2>
            <span class="category-featured-total-ads">
                <h2>
                    <?=$postsCount?>
                    <?=\Yii::t('site', 'ads in')?>
                    <?=sizeof($subcategories)?>
                    <?=\Yii::t('site', 'subcategories')?>
                </h2>
            </span>
        </div>
    </section>

<?=\common\widgets\MapWidget::widget()?>

    <section id="featured-ads-category">
        <div class="container">
            <h3><?=\Yii::t('site', 'Check out our Premium Featured Ads')?></h3>
            <div id="tabs" class="full">
                <ul class="tabs quicktabs-tabs quicktabs-style-nostyle">
                    <li class="grid-feat-ad-style"><a class="" href="#"><?=\Yii::t('site', 'Grid View')?></a></li>
                    <li class="list-feat-ad-style"><a class="" href="#"><?=\Yii::t('site', 'List View')?></a></li>
                </ul>

                <div class="pane">
                    <div id="carousel-buttons">
                        <a href="#" id="carousel-prev">&#8592; <?=\Yii::t('site', 'Previous')?> </a>
                        <a href="#" id="carousel-next"> <?=\Yii::t('site', 'Next')?> &#8594;</a>
                    </div>

                    <div id="projects-carousel">
                        <?php foreach($premiumPosts as $post){ ?>
                            <div class="ad-box span3">
                                <a class="ad-image" href="<?=$post->link?>">
                                    <img width="440px" height="290px" class="add-box-main-image" src="<?=$post->image?>">
                                    <?php if(sizeof($post->images) >= 1){ ?>
                                        <img class="add-box-second-image" src="<?=$post->images[0]?>">
                                    <?php }else{ ?>
                                        <img class="add-box-second-image" src="<?=$post->image?>">
                                    <?php } ?>
                                </a>

                                <div class="ad-box-content">
	                                <span class="ad-category">
                                    <?php if(!empty($category_icon_code)) { ?>
                                        <div class="category-icon-box" style="background-color: <?=$post->category->color?>;"><?=$post->category->icon?></div>
                                    <?php } ?>
                                    </span>

                                    <a href="<?=$post->link?>"><?=$post->title?></a>
                                    <div class="add-price">
                                        <span><?=$post->price?></span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?=$this->registerJsFile('/js/jquery.carouFredSel-6.2.1-packed.js', ['depends' => 'yii\web\JqueryAsset'])?>
                    <?=$this->registerJs("$('#projects-carousel').carouFredSel({
                                auto: false,
                                prev: '#carousel-prev',
                                next: '#carousel-next',
                                pagination: \"#carousel-pagination\",
                                mousewheel: true,
                                swipe: {
                        onMouse: true,
                                    onTouch: true
                                }
                            });")?>
                </div>

                <div class="pane">
                    <?php foreach($premiumPosts as $post){ ?>
                    <div class="list-featured-ads">
                    <div class="list-feat-ad-image">
                        <a class="ad-image" href="<?=$post->link?>">
                            <img src="<?=$post->image?>" height="" width="" class="add-box-main-image">
                            <?php if(sizeof($post->images) >= 1){ ?>
                                <img src="<?=$post->images[0]?>" height="" width="" class="add-box-second-image">
                            <?php }else{ ?>
                                <img src="<?=$post->image?>" height="" width="" class="add-box-second-image">
                            <?php } ?>
                        </a>
                    </div>

                    <div class="list-feat-ad-content">
                        <div class="list-feat-ad-title">
                            <a href="<?=$post->link?>"><?=$post->name?></a>
                            <div class="add-price"><span><?=$post->price?></span></div>
                        </div>

                        <div class="list-feat-ad-excerpt">
                            <p>
                                <?=\common\helpers\TextHelper::limit_text($post->content, 20)?>
                            </p>
                        </div>

                        <div class="read-more">
                            <a href="<?=$post->link?>">
                                <?=\Yii::t('site', 'Details')?>
                            </a>
                        </div>
                    </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

<?php /*

    <section id="ads-category-content">
        <div class="container">
            <div class="span9 first">
                <ul class="tabs quicktabs-tabs quicktabs-style-nostyle">
                    <li >
                        <a style="font-size: 18px !important; font-weight: bold;" class="current" href="#"><?=\Yii::t('site', 'Latest Ads')?></a>
                    </li>
                    <li>
                        <a style="font-size: 18px !important; font-weight: bold;" class="" href="#"><?=\Yii::t('site', 'Most Popular Ads')?></a>
                    </li>
                    <li>
                        <a style="font-size: 18px !important; font-weight: bold;" class="" href="#"><?=\Yii::t('site', 'Random Ads')?></a>
                    </li>
                </ul>

                <div class="pane latest-ads-holder">
                    <div class="latest-ads-grid-holder">
                        <?php while ($wp_query->have_posts()){
                            $wp_query->the_post(); $current++; $current2++; ?>

                            <div class="ad-box span3 latest-posts-grid<?=$current%3 == 0 ? ' first' : ''?>">

                                <a class="ad-image" href="<?=$post->link?>">
                                    <?php

                                    $thumb_id = get_post_thumbnail_id();
                                    $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);

                                    $params = array( 'width' => 440, 'height' => 290, 'crop' => true );
                                    echo "<img class='add-box-main-image' src='" . bfi_thumb( "$thumb_url[0]", $params ) . "'/>";


                                    $attachments = get_children(array('post_parent' => $post->ID,
                                        'post_status' => 'inherit',
                                        'post_type' => 'attachment',
                                        'post_mime_type' => 'image',
                                        'order' => 'ASC',
                                        'orderby' => 'menu_order ID'));

                                    $currentImg = 0;

                                    foreach($attachments as $att_id => $attachment) {
                                        $full_img_url = wp_get_attachment_url($attachment->ID);

                                        $currentImg++;

                                        if($currentImg == 2) {

                                            echo "<img class='add-box-second-image' src='" . bfi_thumb( "$full_img_url", $params ) . "'/>";

                                        }

                                    }

                                    if($currentImg < 2) {

                                        echo "<img class='add-box-second-image' src='" . bfi_thumb( "$thumb_url[0]", $params ) . "'/>";

                                    }


                                    ?>

                                </a>

                                <div class="ad-box-content">

                                    <a href="<?php the_permalink(); ?>"><?php $theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 40) ? substr($theTitle,0,37).'...' : $theTitle; echo $theTitle; ?></a>

                                    <?php $post_price = get_post_meta($post->ID, 'post_price', true); ?>
                                    <div class="add-price"><span><?php echo $post_price; ?></span></div>

                                </div>

                            </div>

                        <?php } ?>
                    </div>
                </div>
                <div class="pane popular-ads-grid-holder">
                    <div class="popular-ads-grid">
                        <?php

                        while ( $popularpost->have_posts() ){
                            $popularpost->the_post(); $current++; $current2++;

                            ?>

                            <div class="ad-box span3 popular-posts-grid <?php if($current%3 == 0) { echo 'first'; } ?>">

                                <a class="ad-image" href="<?php the_permalink(); ?>">
                                    <?php require_once(TEMPLATEPATH . '/inc/BFI_Thumb.php'); ?>

                                    <?php

                                    $thumb_id = get_post_thumbnail_id();
                                    $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);

                                    $params = array( 'width' => 440, 'height' => 290, 'crop' => true );
                                    echo "<img class='add-box-main-image' src='" . bfi_thumb( "$thumb_url[0]", $params ) . "'/>";


                                    $attachments = get_children(array('post_parent' => $post->ID,
                                        'post_status' => 'inherit',
                                        'post_type' => 'attachment',
                                        'post_mime_type' => 'image',
                                        'order' => 'ASC',
                                        'orderby' => 'menu_order ID'));

                                    $currentImg = 0;

                                    foreach($attachments as $att_id => $attachment) {
                                        $full_img_url = wp_get_attachment_url($attachment->ID);

                                        $currentImg++;

                                        if($currentImg == 2) {

                                            echo "<img class='add-box-second-image' src='" . bfi_thumb( "$full_img_url", $params ) . "'/>";

                                        }

                                    }

                                    if($currentImg < 2) {

                                        echo "<img class='add-box-second-image' src='" . bfi_thumb( "$thumb_url[0]", $params ) . "'/>";

                                    }


                                    ?>

                                </a>

                                <div class="ad-box-content">

                                    <a href="<?php the_permalink(); ?>"><?php $theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 40) ? substr($theTitle,0,37).'...' : $theTitle; echo $theTitle; ?></a>

                                    <?php $post_price = get_post_meta($post->ID, 'post_price', true); ?>
                                    <div class="add-price"><span><?php echo $post_price; ?></span></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="pane random-ads-grid-holder">
                    <div class="random-ads-grid">
                        <?php while ($wp_query->have_posts()){
                            $wp_query->the_post(); $current++; $current2++; ?>

                            <div class="ad-box span3 random-posts-grid <?php if($current%3 == 0) { echo 'first'; } ?>">

                                <a class="ad-image" href="<?php the_permalink(); ?>">
                                    <?php require_once(TEMPLATEPATH . '/inc/BFI_Thumb.php'); ?>

                                    <?php

                                    $thumb_id = get_post_thumbnail_id();
                                    $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);

                                    $params = array( 'width' => 440, 'height' => 290, 'crop' => true );
                                    echo "<img class='add-box-main-image' src='" . bfi_thumb( "$thumb_url[0]", $params ) . "'/>";


                                    $attachments = get_children(array('post_parent' => $post->ID,
                                        'post_status' => 'inherit',
                                        'post_type' => 'attachment',
                                        'post_mime_type' => 'image',
                                        'order' => 'ASC',
                                        'orderby' => 'menu_order ID'));

                                    $currentImg = 0;

                                    foreach($attachments as $att_id => $attachment) {
                                        $full_img_url = wp_get_attachment_url($attachment->ID);

                                        $currentImg++;

                                        if($currentImg == 2) {

                                            echo "<img class='add-box-second-image' src='" . bfi_thumb( "$full_img_url", $params ) . "'/>";

                                        }

                                    }

                                    if($currentImg < 2) {

                                        echo "<img class='add-box-second-image' src='" . bfi_thumb( "$thumb_url[0]", $params ) . "'/>";

                                    }


                                    ?>

                                </a>
                                <div class="ad-box-content">
                                    <a href="<?php the_permalink(); ?>"><?php $theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 40) ? substr($theTitle,0,37).'...' : $theTitle; echo $theTitle; ?></a>

                                    <?php $post_price = get_post_meta($post->ID, 'post_price', true); ?>
                                    <div class="add-price"><span><?php echo $post_price; ?></span></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="span3">
                <div class="cat-widget">
                    <div class="cat-widget-title">
                        <h4><?=\Yii::t('site', 'Subcategories')?></h4>
                    </div>
                    <div class="cat-widget-content">
                        <ul>
                            <?php
                            foreach($subcategories as $category) { ?>
                                <li>
                                    <a href="<?=$category->link?>" title="<?=\Yii::t('site', 'View posts in')?> <?php echo $category->name?>"><?php echo $category->name ?></a>
                                    <span class="category-counter"><?php echo $category->count ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php// get_sidebar('pages'); ?>
            </div>
        </div>
    </section>
 */?>

    <script>
        $.(function() {
            $.("ul.tabs").tabs("> .pane", {effect: 'fade', fadeIn: 200});
        });
    </script>