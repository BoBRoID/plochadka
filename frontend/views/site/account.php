<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 13.10.15
 * Time: 16:51
 */

?>

<?php if(false) { ?>
    <section id="featured-ads-author">
        <div class="container">
            <h3><?php echo $user_identity; ?> <?php _e( 'Premium Featured Ads', 'agrg' ); ?></h3>
            <div id="tabs" class="full">
                <?php $cat_id = get_cat_ID(single_cat_title('', false)); ?>

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

                        <?php

                        global $paged, $wp_query, $wp;

                        $args = wp_parse_args($wp->matched_query);

                        $temp = $wp_query;

                        $wp_query= null;

                        $wp_query = new WP_Query();

                        $wp_query->query('post_type=post&posts_per_page=-1&author='.$user_id);

                        $current = -1;

                        ?>

                        <?php while ($wp_query->have_posts()) : $wp_query->the_post();

                            $featured_post = "0";

                            $post_price_plan_activation_date = get_post_meta($post->ID, 'post_price_plan_activation_date', true);
                            $post_price_plan_expiration_date = get_post_meta($post->ID, 'post_price_plan_expiration_date', true);
                            $post_price_plan_expiration_date_noarmal = get_post_meta($current_post, 'post_price_plan_expiration_date_normal', true);
                            $todayDate = strtotime(date('m/d/Y h:i:s'));
                            $expireDate = $post_price_plan_expiration_date;

                            if(!empty($post_price_plan_activation_date)) {

                                if(($todayDate < $expireDate) or $post_price_plan_expiration_date == 0) {
                                    $featured_post = "1";
                                }

                            } ?>

                            <?php if($featured_post == "1") {

                                $current++;

                                ?>

                                <div class="ad-box span3">

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

                                        <a href="<?php the_permalink(); ?>"><?php $theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 40) ? substr($theTitle,0,37).'...' : $theTitle; echo $theTitle; ?></a>

                                        <?php $post_price = get_post_meta($post->ID, 'post_price', true); ?>
                                        <div class="add-price"><span><?php echo $post_price; ?></span></div>

                                    </div>

                                </div>

                            <?php } ?>

                        <?php endwhile; ?>

                        <?php wp_reset_query(); ?>

                    </div>

                    <?php wp_enqueue_script( 'jquery-carousel', get_template_directory_uri().'/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'),'',true); ?>

                    <script>

                        jQuery(document).ready(function () {

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

                        });

                    </script>
                    <!-- end scripts -->

                </div>

                <div class="pane">

                    <?php

                    global $paged, $wp_query, $wp, $current, $current2;

                    $args = wp_parse_args($wp->matched_query);

                    $temp = $wp_query;

                    $wp_query= null;

                    $wp_query = new WP_Query();

                    $wp_query->query('post_type=post&posts_per_page=-1&author='.$user_id);

                    $featuredCurrent = 0;

                    ?>

                    <?php while ($wp_query->have_posts()) : $wp_query->the_post();

                        $featured_post = "0";

                        $post_price_plan_activation_date = get_post_meta($post->ID, 'post_price_plan_activation_date', true);
                        $post_price_plan_expiration_date = get_post_meta($post->ID, 'post_price_plan_expiration_date', true);
                        $post_price_plan_expiration_date_noarmal = get_post_meta($current_post, 'post_price_plan_expiration_date_normal', true);
                        $todayDate = strtotime(date('m/d/Y h:i:s'));
                        $expireDate = $post_price_plan_expiration_date;

                        if(!empty($post_price_plan_activation_date)) {

                            if(($todayDate < $expireDate) or $post_price_plan_expiration_date == 0) {
                                $featured_post = "1";
                            }

                        } ?>

                        <?php if($featured_post == "1") {

                            $current++;

                            ?>

                            <div class="list-featured-ads">

                                <div class="list-feat-ad-image">

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

                                </div>

                                <div class="list-feat-ad-content">

                                    <div class="list-feat-ad-title">

                                        <a href="<?php the_permalink(); ?>"><?php $theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 50) ? substr($theTitle,0,47).'...' : $theTitle; echo $theTitle; ?></a>

                                        <?php $post_price = get_post_meta($post->ID, 'post_price', true); ?>
                                        <div class="add-price"><span><?php echo $post_price; ?></span></div>

                                    </div>

                                    <div class="list-feat-ad-excerpt">
                                        <p>
                                            <?php
                                            $content = get_the_content();
                                            echo wp_trim_words( $content , '20' );
                                            ?>
                                        </p>
                                    </div>

                                    <div class="read-more">	<a href="<?php the_permalink(); ?>"><?php _e( 'Details', 'agrg' ); ?></a></div>

                                </div>

                            </div>


                        <?php } ?>

                    <?php endwhile; ?>

                    <?php wp_reset_query(); ?>

                </div>

            </div>

        </div>

    </section>

<?php } ?>

<section id="ads-profile">

    <div class="container">

        <div class="full" style="margin-top: 20px;">

            <?php

            global $redux_demo;
            $edit = $redux_demo['edit'];

            ?>

            <h3><?php echo $user_identity; ?> <span class="edit-profile"><a class="" href="<?php echo $edit; ?>"><i class="fa fa-cog"></i><?php printf( __( 'Settings', 'agrg' )); ?></a></span></h3>

            <div class="span9 first">

                <div class="span3 first">

                    <div class="author-avatar">
                        <?php require_once(TEMPLATEPATH . '/inc/BFI_Thumb.php'); ?>
                        <?php

                        $author_avatar_url = get_user_meta($user_ID, "flatads_author_avatar_url", true);

                        if(!empty($author_avatar_url)) {

                            $params = array( 'width' => 150, 'height' => 150, 'crop' => true );

                            echo "<img class='author-avatar' src='" . bfi_thumb( "$author_avatar_url", $params ) . "' alt='' />";

                        } else {

                            ?>

                            <?php $avatar_url = wpcook_get_avatar_url ( get_the_author_meta('user_email', $user_ID), $size = '150' ); ?>
                            <img class="author-avatar" src="<?php echo $avatar_url; ?>" alt="" />

                        <?php } ?>
                    </div>

                </div>

                <div class="span6">

                    <div class="full">

                        <h4><?php _e( 'Contact Details', 'agrg' ); ?></h4>

                        <span class="author-details"><i class="fa fa-phone"></i><?php the_author_meta('phone', $user_id); ?></span>

                        <span class="author-details"><i class="fa fa-envelope"></i><a href="mailto:<?php echo get_the_author_meta('user_email', $$user_id); ?>"><?php echo get_the_author_meta('user_email', $user_id); ?></a></span>

                        <span class="author-details"><i class="fa fa-globe"></i><a href="<?php the_author_meta('user_url', $user_id); ?>"><?php the_author_meta('user_url', $user_id); ?></a></span>

                        <span class="author-details"><i class="fa fa-map-marker"></i><?php the_author_meta('address', $user_id); ?></span>

                    </div>

                </div>

                <h4><?php _e( 'Description', 'agrg' ); ?></h4>

                <div class="author-description"><?php $user_id = $current_user->ID; $author_desc = get_the_author_meta('description', $user_id); echo $author_desc; ?></div>

            </div>

            <div class="span3">

                <h4><?php _e( 'Profile Information', 'agrg' ); ?></h4>

					<span class="ad-detail-info"><?php _e( 'Regular Ads', 'agrg' ); ?>
                        <span class="ad-detail"><?php echo $user_post_count = count_user_posts( $user_id ); ?></span>
					</span>

                <?php

                global $redux_demo;

                $featured_ads_option = $redux_demo['featured-options-on'];

                ?>

                <?php if($featured_ads_option == 1) { ?>

                    <?php

                    global $paged, $wp_query, $wp;

                    $args = wp_parse_args($wp->matched_query);

                    $temp = $wp_query;

                    $wp_query= null;

                    $wp_query = new WP_Query();

                    $wp_query->query('post_type=post&posts_per_page=-1&author='.$user_id);

                    $FeaturedAdsCount = 0;

                    ?>

                    <?php while ($wp_query->have_posts()) : $wp_query->the_post();

                        $featured_post = "0";

                        $post_price_plan_activation_date = get_post_meta($post->ID, 'post_price_plan_activation_date', true);
                        $post_price_plan_expiration_date = get_post_meta($post->ID, 'post_price_plan_expiration_date', true);
                        $todayDate = strtotime(date('d/m/Y H:i:s'));
                        $expireDate = strtotime($post_price_plan_expiration_date);

                        if(!empty($post_price_plan_activation_date)) {

                            if(($todayDate < $expireDate) or empty($post_price_plan_expiration_date)) {
                                $featured_post = "1";
                            }

                        } ?>

                        <?php if($featured_post == "1") { $FeaturedAdsCount++; } ?>
                    <?php endwhile; ?>
                    <?php $wp_query = null; $wp_query = $temp;?>

                    <span class="ad-detail-info"><?php _e( 'Featured Ads', 'agrg' ); ?>
                        <span class="ad-detail"><?php echo $FeaturedAdsCount ?></span>
						</span>
                    <?php
                    // set the meta_key to the appropriate custom field meta key

                    global $wpdb;

                    $result = $wpdb->get_results( "SELECT SUM(ads) AS sum FROM 'wpcads_paypal' WHERE user_id = " . $current_user->ID);

                    $allads = $result[0]->sum;

                    $unlimited_ads = get_user_meta( $current_user->ID, 'unlimited', $single);

                    ?>

                    <span class="ad-detail-info"><?php _e( 'Featured Ads left', 'agrg' ); ?>
                        <span class="ad-detail"><?php if($unlimited_ads == "yes") { ?> ∞ <?php } else { echo $allads; } ?></span>
					</span>

                    <div class="pricing-plans">
                        <?php

                        global $redux_demo;
                        $featured_plans = $redux_demo['featured_plans'];

                        ?>
                        <a href="<?php echo $featured_plans; ?>" class="btn"><?php _e( 'See Featured Ads Plans', 'agrg' ); ?></a>
                    </div>

                <?php } ?>

            </div>

        </div>

        <?php

        global $redux_demo;

        $featured_ads_option = $redux_demo['featured-options-on'];

        ?>

        <?php if($featured_ads_option == 1) { ?>

            <div class="full">

                <h3><?php _e( 'My Featured Ad Plans', 'agrg' ); ?></h3>

                <div class="full" style="margin-left: 0px; padding-top: 20px;">

                    <?php

                    global $current_user;
                    get_currentuserinfo();

                    $userID = $current_user->ID;

                    $result = $wpdb->get_results( "SELECT * FROM wpcads_paypal WHERE user_id = $userID ORDER BY main_id DESC" );

                    if ( $result ) { ?>

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

                    <?php } ?>

                </div>

            </div>

        <?php } ?>

        <div class="hr-full"></div>

        <h3><?php echo $user_identity; ?> <?php _e( 'Premium Regular Ads', 'agrg' ); ?></h3>

        <div class="pane latest-ads-holder">

            <div class="latest-ads-grid-holder">

                <?php

                global $paged, $wp_query, $wp;

                $args = wp_parse_args($wp->matched_query);

                if ( !empty ( $args['paged'] ) && 0 == $paged ) {

                    $wp_query->set('paged', $args['paged']);

                    $paged = $args['paged'];

                }

                $past_status = array('publish', 'pending', 'draft');

                $cat_id = get_cat_ID(single_cat_title('', false));

                $temp = $wp_query;

                $wp_query= null;

                $wp_query = new WP_Query();

                $wp_query->query('post_type=post&post_status='.$past_status.'&posts_per_page=12&paged='.$paged.'&cat='.$cat_id.'&author='.$user_ID);

                $current = -1;
                $current2 = 0;

                ?>

                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); $current++; $current2++; ?>

                    <div class="ad-box span3 latest-posts-grid <?php if($current%4 == 0) { echo 'first'; } ?>">

                        <a class="ad-image" href="<?php if ( get_post_status ( $ID ) == 'pending' ) { ?>#<?php } else { the_permalink(); } ?>">
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

                            <a href="<?php if ( get_post_status ( $ID ) == 'pending' ) { ?>#<?php } else { the_permalink(); } ?>"><?php $theTitle = get_the_title(); $theTitle = (strlen($theTitle) > 40) ? substr($theTitle,0,37).'...' : $theTitle; echo $theTitle; ?> <?php if ( get_post_status ( $ID ) == 'pending' ) { ?><?php _e( '(Pending)', 'agrg' ); ?><?php } ?></a>

                            <?php $post_price = get_post_meta($post->ID, 'post_price', true); ?>
                            <div class="add-price"><span><?php echo $post_price; ?></span></div>

                            <?php

                            global $redux_demo;
                            $edit_post_page_id = $redux_demo['edit_post'];
                            $postID = $post->ID;

                            global $wp_rewrite;
                            if ($wp_rewrite->permalink_structure == '') {
                                //we are using ?page_id
                                $edit_post = $edit_post_page_id."&post=".$postID;
                            } else {
                                //we are using permalinks
                                $edit_post = $edit_post_page_id."?post=".$postID;
                            }

                            ?>

                            <a class="author-edit-post" href="<?php echo $edit_post; ?>"><i class="fa fa-pencil"></i><?php _e( 'Edit', 'agrg' ); ?></a>

                            <form onSubmit="return confirm('Do you really want to delete this?');" name="theForm<?php the_ID(); ?>" class="delete-listing" action="" method="post">

                                <input type="hidden" name="deletepostid" value="<?php the_ID(); ?>" />

                                <a class='author-delete-post' onclick='return confirm("Are you sure you want to delete this?")' href='javascript:document.theForm<?php the_ID(); ?>.submit();'><i class='fa fa-trash-o'></i><?php _e( 'Delete', 'agrg' ); ?></a>

                            </form>

                        </div>

                    </div>

                <?php endwhile; ?>

            </div>
        </div>
    </div>
</section>

<script>
    // perform JavaScript after the document is scriptable.
    jQuery(function() {
        jQuery("ul.tabs").tabs("> .pane", {effect: 'fade', fadeIn: 200});
    });
</script>