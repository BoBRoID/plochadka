<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 13.10.15
 * Time: 16:51
 */

$js = <<<'SCRIPT'
jQuery('#projects-carousel').carouFredSel({
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

jQuery(function() {
    jQuery("ul.tabs").tabs("> .pane", {effect: 'fade', fadeIn: 200});
});
SCRIPT;

$this->registerJsFile('js/jquery.carouFredSel-6.2.1-packed');

$this->registerJs($js);


?>

<?php if(true) { ?>
    <section id="featured-ads-author">
        <div class="container">
            <h3><?=$account->username?> <?=\Yii::t('site', 'Premium Featured Ads')?></h3>
            <div id="tabs" class="full">
                <ul class="tabs quicktabs-tabs quicktabs-style-nostyle">
                    <li class="grid-feat-ad-style"><a class="" href="#">Grid View</a></li>
                    <li class="list-feat-ad-style"><a class="" href="#">List View</a></li>
                </ul>

                <div class="pane">

                    <div id="carousel-buttons">
                        <a href="#" id="carousel-prev">&#8592; Previous </a>
                        <a href="#" id="carousel-next"> Next &#8594;</a>
                    </div>

                    <div id="projects-carousel">
                        <?php foreach([] as $post){ ?>
                        <div class="ad-box span3">
                            <a class="ad-image" href="">
                                <img class='add-box-main-image' src='" . bfi_thumb( "$thumb_url[0]", $params ) . "'/>
                                <img class='add-box-second-image' src='" . bfi_thumb( "$full_img_url", $params ) . "'/>
                            </a>

                            <div class="ad-box-content">
                                <span class="ad-category">
                                    <div class="category-icon-box" style="background-color: <?php //echo $category_icon_color; ?>;"><?php //$category_icon = stripslashes($category_icon_code); echo $category_icon; ?></div>
                                </span>

                                <a href="<?php //the_permalink(); ?>"><?php //$theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 40) ? substr($theTitle,0,37).'...' : $theTitle; echo $theTitle; ?></a>

                                <div class="add-price">
                                    <span><?php //echo $post_price; ?></span>
                                </div>

                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="pane">

                    <?php foreach([] as $post){ ?>
                    <div class="list-featured-ads">
                        <div class="list-feat-ad-image">
                            <a class="ad-image" href="">
                                <img class='add-box-main-image' src='" . bfi_thumb( "$thumb_url[0]", $params ) . "'/>
                                <img class='add-box-second-image' src='" . bfi_thumb( "$full_img_url", $params ) . "'/>
                            </a>
                        </div>

                        <div class="list-feat-ad-content">
                            <div class="list-feat-ad-title">
                                <a href="<?php //the_permalink(); ?>"><?php //$theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 50) ? substr($theTitle,0,47).'...' : $theTitle; echo $theTitle; ?></a>
                                <div class="add-price"><span><?php //echo $post_price; ?></span></div>
                            </div>

                            <div class="list-feat-ad-excerpt">
                                <p>
                                    <?php
                                    //echo wp_trim_words( $content , '20' );
                                    ?>
                                </p>
                            </div>

                            <div class="read-more">	<a href="<?php //the_permalink(); ?>"><?php //_e( 'Details', 'agrg' ); ?></a></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<section id="ads-profile">
    <div class="container">
        <div class="full" style="margin-top: 20px;">
            <h3><?=$account->username?>
                <span class="edit-profile">
                    <a class="" href="<?=\yii\helpers\Url::toRoute(['myaccount', 'act' => 'edit'])?>">
                        <i class="fa fa-cog"></i>
                        <?=\Yii::t('site', 'Settings')?>
                    </a>
                </span>
            </h3>

            <div class="span9 first">
                <div class="span3 first">
                    <div class="author-avatar">
                        <img class='author-avatar' src='" . bfi_thumb( "$author_avatar_url", $params ) . "' alt='' />
                    </div>
                </div>

                <div class="span6">
                    <div class="full">
                        <h4><?=\Yii::t('site', 'Contact Details')?></h4>

                        <span class="author-details">
                            <i class="fa fa-phone"></i>
                        </span>

                        <span class="author-details">
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:<?php //echo get_the_author_meta('user_email', $$user_id); ?>">
                                <?php //echo get_the_author_meta('user_email', $user_id); ?>
                            </a>
                        </span>

                        <span class="author-details">
                            <i class="fa fa-globe"></i>
                            <a href="<?php //the_author_meta('user_url', $user_id); ?>"><?php //the_author_meta('user_url', $user_id); ?></a>
                        </span>

                        <span class="author-details">
                            <i class="fa fa-map-marker"></i>
                            <?php //the_author_meta('address', $user_id); ?>
                        </span>
                    </div>
                </div>

                <h4><?=\Yii::t('site', 'Description')?></h4>

                <div class="author-description">
                    <?php //$user_id = $current_user->ID; $author_desc = get_the_author_meta('description', $user_id); echo $author_desc; ?>
                </div>
            </div>

            <div class="span3">
                <h4><?=\Yii::t('site', 'Profile Information')?></h4>

					<span class="ad-detail-info"><?=\Yii::t('site', 'Regular Ads')?>
                        <span class="ad-detail">$user_post_count</span>
					</span>

                <?php if(true) { ?>

                    <span class="ad-detail-info">
                        <?=\Yii::t('site', 'Featured Ads')?>
                        <span class="ad-detail">$FeaturedAdsCount</span>
					</span>

                    <span class="ad-detail-info"><?=\Yii::t('site', 'Featured Ads left')?>
                        <span class="ad-detail">$allads</span>
					</span>

                    <div class="pricing-plans">
                        <a href="$featured_plans" class="btn"><?=\Yii::t('site', 'See Featured Ads Plans')?></a>
                    </div>

                <?php } ?>

            </div>

        </div>


        <?php if(false) { ?>

        <div class="full">
            <h3><?=\Yii::t('site', 'My Featured Ad Plans')?></h3>
            <div class="full" style="margin-left: 0px; padding-top: 20px;">
                <div class="full-boxed-pricing">
                    <div class="price-table-header">
                        <div class="price-table-header-name"><span><?php _e( 'Name', 'agrg' ); ?></span></div>
                        <div class="price-table-header-ads"><span><?php _e( 'Ads', 'agrg' ); ?></span></div>
                        <div class="price-table-header-used"><span><?php _e( 'Used', 'agrg' ); ?></span></div>
                        <div class="price-table-header-days"><span><?php _e( 'Active', 'agrg' ); ?></span></div>
                        <div class="price-table-header-price"><span><?php _e( 'Price', 'agrg' ); ?></span></div>
                        <div class="price-table-header-status"><span><?php _e( 'Status', 'agrg' ); ?></span></div>
                        <div class="price-table-header-date"><span><?php _e( 'Date', 'agrg' ); ?></span></div>

                    </div>
                            <?php

                            foreach ( $result as $info ) {
                                if($info->status != "in progress") {
                                    ?>

                                    <div class="price-table-row" <?php if($info->status == "pending") {  ?>style="background: #fce3e3;"<?php } ?>>

                                        <div class="price-table-row-name"><span><?php echo $info->name; ?></span></div>
                                        <div class="price-table-row-ads"><span><?php if(empty($info->ads)) { ?> ∞ <?php } else { echo $info->ads; } ?></span></div>
                                        <div class="price-table-row-used"><span><?php echo $info->used; ?></span></div>
                                        <div class="price-table-row-days"><span><?php if(empty($info->days)) { ?>∞<?php } else { echo $info->days; } ?> <?php _e( 'Days', 'agrg' ); ?></span></div>
                                        <div class="price-table-row-price"><span><?php echo $info->price; ?> <?php echo $info->currency; ?></span></div>
                                        <div class="price-table-row-status"><span <?php if($info->status == "success") {  ?>style="color: #40a000;"<?php } elseif($info->status == "pending") {  ?>style="color: #a02600;"<?php } ?>><?php echo $info->status; ?></span></div>
                                        <div class="price-table-row-date"><span><?php echo $info->date; ?></span></div>

                                    </div>

                                <?php }
                            } ?>

                        </div>
                </div>

            </div>

        <?php } ?>

        <div class="hr-full"></div>

        <h3><?=$account->username?> <?=\Yii::t('site', 'Premium Regular Ads')?></h3>

        <div class="pane latest-ads-holder">
            <div class="latest-ads-grid-holder">
                <?php foreach([] as $item){ ?>
                <div class="ad-box span3 latest-posts-grid <?php if($current%4 == 0) { echo 'first'; } ?>">
                    <a class="ad-image" href="<?php //if ( get_post_status ( $ID ) == 'pending' ) { ?>#<?php //} else { the_permalink(); } ?>">
                        <img class='add-box-main-image' src='" . bfi_thumb( "$thumb_url[0]", $params ) . "'/>
                        <img class='add-box-second-image' src='" . bfi_thumb( "$full_img_url", $params ) . "'/>
                    </a>
                    <div class="ad-box-content">
				    			<span class="ad-category">
                                    <div class="category-icon-box" style="background-color: <?php //echo $category_icon_color; ?>;"><?php //$category_icon = stripslashes($category_icon_code); echo $category_icon; ?></div>
				    			</span>
                        <a href="<?php //if ( get_post_status ( $ID ) == 'pending' ) { ?>#<?php //} else { the_permalink(); } ?>"><?php //$theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 40) ? substr($theTitle,0,37).'...' : $theTitle; echo $theTitle; ?> <?php //if ( get_post_status ( $ID ) == 'pending' ) { ?><?php //_e( '(Pending)', 'agrg' ); ?><?php //} ?></a>
                        <div class="add-price"><span><?php //echo $post_price; ?></span></div>

                        <a class="author-edit-post" href="<?php //echo $edit_post; ?>"><i class="fa fa-pencil"></i><?php //_e( 'Edit', 'agrg' ); ?></a>

                        <form onSubmit="return confirm('Do you really want to delete this?');" name="theForm<?php //the_ID(); ?>" class="delete-listing" action="" method="post">
                            <input type="hidden" name="deletepostid" value="<?php //the_ID(); ?>" />
                            <a class='author-delete-post' onclick='return confirm("Are you sure you want to delete this?")' href='javascript:document.theForm<?php //the_ID(); ?>.submit();'><i class='fa fa-trash-o'></i><?php //_e( 'Delete', 'agrg' ); ?></a>
                        </form>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>