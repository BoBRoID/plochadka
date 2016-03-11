<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FlatAds
 * @since FlatAds 1.0
 */

use yii\bootstrap\Html;
use yii\data\ArrayDataProvider;
use yii\widgets\ListView;

$js = <<<'SCRIPT'
$('#projects-carousel').carouFredSel({
    auto: false,
    prev: '#carousel-prev',
    next: '#carousel-next',
    pagination: "#carousel-pagination",
    mousewheel: true,
    swipe: {
        onMouse: true,
        onTouch: true
    }
});

$(function() {
    $("ul.tabs").tabs("> .pane", {effect: 'fade', fadeIn: 200});
});
SCRIPT;

$this->registerJs($js);
\frontend\assets\FeauteredAdsAsset::register($this);

\rmrevin\yii\fontawesome\AssetBundle::register($this);

?>
<?=\common\widgets\MapWidget::widget()?>

<section id="featured-list">
    <div class="container">
        <h3><?=\Yii::t('site', 'Check out our Premium Featured Ads')?></h3>
        <div id="tabs" class="full">
            <ul class="tabs quicktabs-tabs quicktabs-style-nostyle">
                <li class="grid-feat-ad-style"><a class="" href="#"><?=''?></a></li>
                <li class="list-feat-ad-style"><a class="" href="#"><?=\Yii::t('site', 'List View')?></a></li>
            </ul>

            <div class="pane">
                <div id="carousel-buttons">
                    <a href="#" id="carousel-prev">&#8592; <?=\Yii::t('site', 'Previous')?> </a>
                    <a href="#" id="carousel-next"> <?=\Yii::t('site', 'Next')?> &#8594;</a>
                </div>

                <?=ListView::widget([
                    'options'   =>  [
                        'id'    =>  'projects-carousel',
                    ],
                    'itemOptions'   =>  [
                        'class' =>  'ad-box span3'
                    ],
                    'summary'       =>  false,
                    'dataProvider'  =>  $postsDataProvider,
                    'itemView'      =>  function($post){
                        return $this->render('index/_post_card', [
                            'post'  =>  $post
                        ]);
                    }
                ])?>
            </div>

            <?=ListView::widget([
                'options'   =>  [
                    'class' =>  'pane',
                    'style' =>  'display: none'
                ],
                'summary'       =>  false,
                'dataProvider'  =>  $postsDataProvider,
                'itemView'      =>  function($post){
                    return $this->render('index/_post_line', [
                        'post'  =>  $post
                    ]);
                }
            ])?>
        </div>
    </div>
</section>
<section id="categories-homepage">
    <div class="container">
        <?=Html::tag('h3', \Yii::t('site', 'Browse our {adsCount} Ads from {categoriesCount, plural, one{one category} other{# categories}}', [
            'adsCount'  =>  '22',
            'categoriesCount'   =>  '1'
        ]))?>

        <?=ListView::widget([
            'dataProvider'      =>  new ArrayDataProvider([
                'models'        =>  $categories
            ]),
            'options'           =>  [
                'class'     =>  'full'
            ],
            'summary'           =>  false,
            'itemView'          =>  function($model, $key, $counter){
                $counter = $counter - 1;

                return $this->render('index/category', [
                    'category'  =>  $model,
                    'current'   =>  ($counter - 1)
                ]);
            }
        ])?>
        <div class="full">

        <?php
        $current = 0;

        \rmrevin\yii\fontawesome\cdn\AssetBundle::register($this);

        foreach($categories as $category){

            echo $this->render('index/category', [
                'category'  =>  $category,
                'current'   =>  $current
            ]);

        $current++;
        } ?>
        </div>
    </div>
</section>
<?php
/*

    <section id="categories-homepage">

        <div class="container">

            <?php $categories = get_categories('hide_empty=0');

            $currentCat = 0;

            foreach ($categories as $category) {

                if ($category->category_parent == 0) {

                    $currentCat++;

                }

            }

            ?>

            <h3><?php _e( 'Browse our', 'agrg' ); ?>  <?php $numpost = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post'"); echo $numpost; ?> <?php _e( 'Ads from', 'agrg' ); ?> <?php echo $currentCat; ?> <?php _e( 'Categories', 'agrg' ); ?></h3>

            <div class="full">

                <?php $categories = get_categories('hide_empty=0');

                $current = -1;

                foreach ($categories as $category) {

                    if ($category->category_parent == 0) {

                        $tag = $category->cat_ID;

                        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
                        if (isset($tag_extra_fields[$tag])) {
                            $category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
                            $category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
                        }

                        $cat = $category->count;
                        $catName = $category->cat_ID;

                        $current++;
                        $allPosts = 0;

                        $categories = get_categories('child_of='.$catName);
                        foreach ($categories as $category) {
                            $allPosts += $category->category_count;
                        }

                        ?>

                        <div class="category-box span3 <?php if($current%4 == 0) { echo 'first'; } ?>">

                            <div class="category-header">

            			<span class="category-icon">
		    				<?php if(!empty($category_icon_code)) { ?>

                                <div class="category-icon-box" style="background-color: <?php echo $category_icon_color; ?>;"><?php $category_icon = stripslashes($category_icon_code); echo $category_icon; ?></div>

                            <?php } ?>
		    			</span>

                                <span class="cat-title"><a href="<?php echo get_category_link( $catName ) ?>"><h4><?php echo get_cat_name( $catName ); ?></h4></a></span>

                                <span class="category-total"><h4><?php echo $allPosts; ?></h4></span>

                            </div>

                            <div class="category-content">

                                <ul>

                                    <?php

                                    $currentCat = 0;

                                    $args2 = array(
                                        'type' => 'post',
                                        'child_of' => $catName,
                                        'parent' => get_query_var(''),
                                        'orderby' => 'name',
                                        'order' => 'ASC',
                                        'hide_empty' => 0,
                                        'hierarchical' => 1,
                                        'exclude' => '',
                                        'include' => '',
                                        'number' => '',
                                        'taxonomy' => 'category',
                                        'pad_counts' => true );

                                    $categories2 = get_categories($args2);

                                    foreach($categories2 as $category2) {
                                        $currentCat++;
                                    }

                                    $args = array(
                                        'type' => 'post',
                                        'child_of' => $catName,
                                        'parent' => get_query_var(''),
                                        'orderby' => 'name',
                                        'order' => 'ASC',
                                        'hide_empty' => 0,
                                        'hierarchical' => 1,
                                        'exclude' => '',
                                        'include' => '',
                                        'number' => '5',
                                        'taxonomy' => 'category',
                                        'pad_counts' => true );

                                    $categories = get_categories($args);
                                    foreach($categories as $category) {
                                        ?>

                                        <li>
                                            <a href="<?php echo get_category_link( $category->term_id )?>" title="View posts in <?php echo $category->name?>">
                                                <?php $categoryTitle = $category->name; $categoryTitle = (strlen($categoryTitle) > 30) ? substr($categoryTitle,0,27).'...' : $categoryTitle; echo $categoryTitle; ?>
                                            </a>
                                            <span class="category-counter"><?php echo $category->count ?></span>
                                        </li>

                                    <?php } ?>

                                    <?php if($currentCat > 5) { ?>

                                        <li>
                                            <a href="<?php echo get_category_link( $catName ) ?>">View all subcategories &rarr;</a>
                                        </li>

                                    <?php } ?>

                                </ul>

                            </div>

                        </div>

                    <?php } } ?>

            </div>

        </div>

    </section>

    <section id="ads-homepage">

        <div class="container">

            <ul class="tabs quicktabs-tabs quicktabs-style-nostyle">
                <li >
                    <a style="font-size: 18px !important; font-weight: bold;" class="current" href="#"><?php _e( 'Latest Ads', 'agrg' ); ?></a>
                </li>
                <li>
                    <a style="font-size: 18px !important; font-weight: bold;" class="" href="#"><?php _e( 'Most Popular Ads', 'agrg' ); ?></a>
                </li>
                <li>
                    <a style="font-size: 18px !important; font-weight: bold;" class="" href="#"><?php _e( 'Random Ads', 'agrg' ); ?></a>
                </li>
            </ul>

            <div class="pane latest-ads-holder">

                <div class="latest-ads-grid-holder">

                    <?php

                    global $paged, $wp_query, $wp;

                    $args = wp_parse_args($wp->matched_query);

                    if ( !empty ( $args['paged'] ) && 0 == $paged ) {

                        $wp_query->set('paged', $args['paged']);

                        $paged = $args['paged'];

                    }

                    $cat_id = get_cat_ID(single_cat_title('', false));

                    $temp = $wp_query;

                    $wp_query= null;

                    $wp_query = new WP_Query();

                    $wp_query->query('post_type=post&posts_per_page=12&paged='.$paged.'&cat='.$cat_id);

                    $current = -1;
                    $current2 = 0;

                    ?>

                    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); $current++; $current2++; ?>

                        <div class="ad-box span3 latest-posts-grid <?php if($current%4 == 0) { echo 'first'; } ?>">

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

				    			<span class="ad-category">
				    					
				    				<?php

                                    $category = get_the_category();

                                    if ($category[0]->category_parent == 0) {

                                        $tag = $category[0]->cat_ID;

                                        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
                                        if (isset($tag_extra_fields[$tag])) {
                                            $category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
                                            $category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
                                        }

                                    } else {

                                        $tag = $category[0]->category_parent;

                                        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
                                        if (isset($tag_extra_fields[$tag])) {
                                            $category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
                                            $category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
                                        }

                                    }

                                    if(!empty($category_icon_code)) {

                                        ?>

                                        <div class="category-icon-box" style="background-color: <?php echo $category_icon_color; ?>;"><?php $category_icon = stripslashes($category_icon_code); echo $category_icon; ?></div>

                                    <?php }

                                    $category_icon_code = "";

                                    ?>

				    			</span>

                                <a href="<?php the_permalink(); ?>"><?php $theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 50) ? substr($theTitle,0,47).'...' : $theTitle; echo $theTitle; ?></a>

                                <?php $post_price = get_post_meta($post->ID, 'post_price', true); ?>
                                <div class="add-price"><span><?php echo $post_price; ?></span></div>

                            </div>

                        </div>

                    <?php endwhile; ?>

                </div>

                <!-- Begin wpcrown_pagination-->
                <?php get_template_part('pagination'); ?>
                <!-- End wpcrown_pagination-->

                <?php wp_reset_query(); ?>

            </div>

            <div class="pane popular-ads-grid-holder">

                <div class="popular-ads-grid">

                    <?php

                    global $paged, $wp_query, $wp;

                    $args = wp_parse_args($wp->matched_query);

                    if ( !empty ( $args['paged'] ) && 0 == $paged ) {

                        $wp_query->set('paged', $args['paged']);

                        $paged = $args['paged'];

                    }

                    $cat_id = get_cat_ID(single_cat_title('', false));


                    $current = -1;
                    $current2 = 0;


                    $popularpost = new WP_Query( array( 'posts_per_page' => '12', 'cat' => $cat_id, 'posts_type' => 'post', 'paged' => $paged, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );

                    while ( $popularpost->have_posts() ) : $popularpost->the_post(); $current++; $current2++;

                        ?>

                        <div class="ad-box span3 popular-posts-grid <?php if($current%4 == 0) { echo 'first'; } ?>">

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

				    			<span class="ad-category">
				    					
				    				<?php

                                    $category = get_the_category();

                                    if ($category[0]->category_parent == 0) {

                                        $tag = $category[0]->cat_ID;

                                        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
                                        if (isset($tag_extra_fields[$tag])) {
                                            $category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
                                            $category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
                                        }

                                    } else {

                                        $tag = $category[0]->category_parent;

                                        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
                                        if (isset($tag_extra_fields[$tag])) {
                                            $category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
                                            $category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
                                        }

                                    }

                                    if(!empty($category_icon_code)) {

                                        ?>

                                        <div class="category-icon-box" style="background-color: <?php echo $category_icon_color; ?>;"><?php $category_icon = stripslashes($category_icon_code); echo $category_icon; ?></div>

                                    <?php }

                                    $category_icon_code = "";

                                    ?>

				    			</span>

                                <a href="<?php the_permalink(); ?>"><?php $theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 50) ? substr($theTitle,0,47).'...' : $theTitle; echo $theTitle; ?></a>

                                <?php $post_price = get_post_meta($post->ID, 'post_price', true); ?>
                                <div class="add-price"><span><?php echo $post_price; ?></span></div>

                            </div>

                        </div>

                    <?php endwhile; ?>

                </div>

                <!-- Begin wpcrown_pagination-->
                <?php get_template_part('pagination'); ?>
                <!-- End wpcrown_pagination-->

                <?php wp_reset_query(); ?>

            </div>

            <div class="pane random-ads-grid-holder">

                <div class="random-ads-grid">

                    <?php

                    global $paged, $wp_query, $wp;

                    $args = wp_parse_args($wp->matched_query);

                    if ( !empty ( $args['paged'] ) && 0 == $paged ) {

                        $wp_query->set('paged', $args['paged']);

                        $paged = $args['paged'];

                    }

                    $cat_id = get_cat_ID(single_cat_title('', false));

                    $temp = $wp_query;

                    $wp_query= null;

                    $wp_query = new WP_Query();

                    $wp_query->query('orderby=title&post_type=post&posts_per_page=12&paged='.$paged.'&cat='.$cat_id);

                    $current = -1;
                    $current2 = 0;

                    ?>

                    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); $current++; $current2++; ?>

                        <div class="ad-box span3 random-posts-grid <?php if($current%4 == 0) { echo 'first'; } ?>">

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

				    			<span class="ad-category">
				    					
				    				<?php

                                    $category = get_the_category();

                                    if ($category[0]->category_parent == 0) {

                                        $tag = $category[0]->cat_ID;

                                        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
                                        if (isset($tag_extra_fields[$tag])) {
                                            $category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
                                            $category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
                                        }

                                    } else {

                                        $tag = $category[0]->category_parent;

                                        $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
                                        if (isset($tag_extra_fields[$tag])) {
                                            $category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
                                            $category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
                                        }

                                    }

                                    if(!empty($category_icon_code)) {

                                        ?>

                                        <div class="category-icon-box" style="background-color: <?php echo $category_icon_color; ?>;"><?php $category_icon = stripslashes($category_icon_code); echo $category_icon; ?></div>

                                    <?php }

                                    $category_icon_code = "";

                                    ?>

				    			</span>

                                <a href="<?php the_permalink(); ?>"><?php $theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 50) ? substr($theTitle,0,47).'...' : $theTitle; echo $theTitle; ?></a>

                                <?php $post_price = get_post_meta($post->ID, 'post_price', true); ?>
                                <div class="add-price"><span><?php echo $post_price; ?></span></div>

                            </div>

                        </div>

                    <?php endwhile; ?>

                </div>

                <!-- Begin wpcrown_pagination-->
                <?php get_template_part('pagination'); ?>
                <!-- End wpcrown_pagination-->

            </div>
        </div>
    </section>
*/?>


<script>
    jQuery(function() {
        jQuery("ul.tabs").tabs("> .pane", {effect: 'fade', fadeIn: 200});
    });
</script>
