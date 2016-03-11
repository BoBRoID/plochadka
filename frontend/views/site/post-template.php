    <section id="ad-page-title" class="add-new-post-header" >

        <div class="container">

            <div class="span9 first">
                <h2><?php the_title(); ?></h2>

            </div>

            <div class="span3"><h4 style="margin-top: 7px;"><?php _e('Account Overview', 'agrg') ?></h4></div>

        </div>

    </section>

    <section class="ads-main-page">

        <div class="container">

            <div class="span9 first">

                <div id="upload-ad" class="ad-detail-content">

                    <form class="form-item" action="" id="primaryPostForm" method="POST" enctype="multipart/form-data">

                        <?php if($postTitleError != '') { ?>
                            <span class="error" style="color: #d20000; margin-bottom: 20px; font-size: 18px; font-weight: bold; float: left;"><?php echo $postTitleError; ?></span>
                            <div class="clearfix"></div>
                        <?php } ?>


                        <?php if($catError != '') { ?>
                            <span class="error" style="color: #d20000; margin-bottom: 20px; font-size: 18px; font-weight: bold; float: left;"><?php echo $catError; ?></span>
                            <div class="clearfix"></div>
                        <?php } ?>

                        <fieldset class="input-title">

                            <label for="edit-title" class="control-label"><?php _e('Title *', 'agrg') ?></label>
                            <input type="text" id="postTitle" name="postTitle" value="" size="60" maxlength="255" class="form-text required">

                        </fieldset>


                        <div id="edit-field-category">
                            <div class="form-item">
                                <label for="edit-field-category-und" class="control-label"><?php _e('Category *', 'agrg') ?></label>

                                <?php wp_dropdown_categories( 'show_option_none=Category&hide_empty=0&hierarchical=1&id=catID' ); ?>

                            </div>
                        </div>

                        <?php
                        $args = array(
                            'hide_empty' => false,
                            'orderby' => count,
                            'order' => 'ASC'
                        );

                        $inum = 0;

                        $categories = get_categories($args);
                        foreach($categories as $category) {;

                            $inum++;

                            $user_name = $category->name;
                            $user_id = $category->term_id;


                            $tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
                            $wpcrown_category_custom_field_option = $tag_extra_fields[$user_id]['category_custom_fields'];

                            if(empty($wpcrown_category_custom_field_option)) {

                                $catobject = get_category($user_id,false);
                                $parentcat = $catobject->category_parent;

                                $wpcrown_category_custom_field_option = $tag_extra_fields[$parentcat]['category_custom_fields'];
                            }
                            ?>

                            <div id="cat-<?php echo $user_id; ?>" class="wrap-content" style="display: none;">

                                <?php
                                for ($i = 0; $i < (count($wpcrown_category_custom_field_option)); $i++) {
                                    ?>

                                    <fieldset class="input-title">

                                        <label for="edit-title" class="control-label"><?php if (!empty($wpcrown_category_custom_field_option[$i][0])) echo $wpcrown_category_custom_field_option[$i][0]; ?></label>

                                        <input type="hidden" class="custom_field" id="custom_field[<?php echo $i; ?>][0]" name="custom_field[<?php echo $i; ?>][0]" value="<?php if (!empty($wpcrown_category_custom_field_option[$i][0])) echo $wpcrown_category_custom_field_option[$i][0]; ?>" >

                                        <input type="text" class="custom_field" id="custom_field[<?php echo $i; ?>][1]" name="custom_field[<?php echo $i; ?>][1]" value="" >

                                    </fieldset>

                                <?php
                                }
                                ?>


                            </div>

                        <?php } ?>

                        <div id="price-field">

                            <label for="edit-field-category-und" class="control-label"><?php _e('Price', 'agrg') ?></label>
                            <input type="text" id="post_price" name="post_price" value="" size="12" class="form-text required">
                            <p class="help-block"><?php _e('Leave empty for free listing', 'agrg') ?></p>

                        </div>

                        <fieldset class="input-title">

                            <label for="edit-title" class="control-label"><?php _e('Location', 'agrg') ?></label>
                            <input type="text" id="post_location" name="post_location" value="" size="12" maxlength="110" class="form-text required">

                        </fieldset>

                        <label for="edit-title" class="control-label"><?php _e('Description *', 'agrg') ?></label>

                        <?php

                        $settings = array(
                            'wpautop' => true,
                            'postContent' => 'content',
                            'media_buttons' => false,
                            'tinymce' => array(
                                'theme_advanced_buttons1' => 'bold,italic,underline,blockquote,separator,strikethrough,bullist,numlist,justifyleft,justifycenter,justifyright,undo,redo,link,unlink,fullscreen',
                                'theme_advanced_buttons2' => 'pastetext,pasteword,removeformat,|,charmap,|,outdent,indent,|,undo,redo',
                                'theme_advanced_buttons3' => '',
                                'theme_advanced_buttons4' => ''
                            ),
                            'quicktags' => array(
                                'buttons' => 'b,i,ul,ol,li,link,close'
                            )
                        );

                        wp_editor( $postContent, 'postContent', $settings );

                        ?>

                        <div class="hr-line"></div>

                        <label for="edit-title" class="control-label"><?php _e('Address', 'agrg') ?></label>

                        <div id="map-container">

                            <input id="address" name="address" type="textbox" value="">

                            <p class="help-block"><?php _e('Start typing an address and select from the dropdown.', 'agrg') ?></p>

                            <div id="map-canvas"></div>

                            <script type="text/javascript">

                                jQuery(document).ready(function($) {

                                    var geocoder;
                                    var map;
                                    var marker;

                                    var geocoder = new google.maps.Geocoder();

                                    function geocodePosition(pos) {
                                        geocoder.geocode({
                                            latLng: pos
                                        }, function(responses) {
                                            if (responses && responses.length > 0) {
                                                updateMarkerAddress(responses[0].formatted_address);
                                            } else {
                                                updateMarkerAddress('Cannot determine address at this location.');
                                            }
                                        });
                                    }

                                    function updateMarkerPosition(latLng) {
                                        jQuery('#latitude').val(latLng.lat());
                                        jQuery('#longitude').val(latLng.lng());
                                    }

                                    function updateMarkerAddress(str) {
                                        jQuery('#address').val(str);
                                    }

                                    function initialize() {

                                        var latlng = new google.maps.LatLng(0, 0);
                                        var mapOptions = {
                                            zoom: 2,
                                            center: latlng
                                        }

                                        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                                        geocoder = new google.maps.Geocoder();

                                        marker = new google.maps.Marker({
                                            position: latlng,
                                            map: map,
                                            draggable: true
                                        });

                                        // Add dragging event listeners.
                                        google.maps.event.addListener(marker, 'dragstart', function() {
                                            updateMarkerAddress('Dragging...');
                                        });

                                        google.maps.event.addListener(marker, 'drag', function() {
                                            updateMarkerPosition(marker.getPosition());
                                        });

                                        google.maps.event.addListener(marker, 'dragend', function() {
                                            geocodePosition(marker.getPosition());
                                        });

                                    }

                                    google.maps.event.addDomListener(window, 'load', initialize);

                                    jQuery(document).ready(function() {

                                        initialize();

                                        jQuery(function() {
                                            jQuery("#address").autocomplete({
                                                //This bit uses the geocoder to fetch address values
                                                source: function(request, response) {
                                                    geocoder.geocode( {'address': request.term }, function(results, status) {
                                                        response(jQuery.map(results, function(item) {
                                                            return {
                                                                label:  item.formatted_address,
                                                                value: item.formatted_address,
                                                                latitude: item.geometry.location.lat(),
                                                                longitude: item.geometry.location.lng()
                                                            }
                                                        }));
                                                    })
                                                },
                                                //This bit is executed upon selection of an address
                                                select: function(event, ui) {
                                                    jQuery("#latitude").val(ui.item.latitude);
                                                    jQuery("#longitude").val(ui.item.longitude);

                                                    var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);

                                                    marker.setPosition(location);
                                                    map.setZoom(16);
                                                    map.setCenter(location);

                                                }
                                            });
                                        });

                                        //Add listener to marker for reverse geocoding
                                        google.maps.event.addListener(marker, 'drag', function() {
                                            geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                                                if (status == google.maps.GeocoderStatus.OK) {
                                                    if (results[0]) {
                                                        jQuery('#address').val(results[0].formatted_address);
                                                        jQuery('#latitude').val(marker.getPosition().lat());
                                                        jQuery('#longitude').val(marker.getPosition().lng());
                                                    }
                                                }
                                            });
                                        });

                                    });

                                });

                            </script>

                        </div>


                        <div id="latitude-field">

                            <label for="edit-field-category-und" class="control-label"><?php _e('Latitude', 'agrg') ?></label>
                            <input type="text" id="latitude" name="latitude" value="" size="12" maxlength="10" class="form-text required">

                        </div>

                        <div id="longitude-field">

                            <label for="edit-field-category-und" class="control-label"><?php _e('Longitude', 'agrg') ?></label>
                            <input type="text" id="longitude" name="longitude" value="" size="12" maxlength="10" class="form-text required">

                        </div>

                        <div class="hr-line"></div>

                        <fieldset class="input-title">

                            <label for="edit-field-category-und" class="control-label"><?php _e('Tags', 'agrg') ?></label>
                            <input type="text" id="post_tags" name="post_tags" value="" size="12" maxlength="110" class="form-text required">
                            <p class="help-block"><?php _e('Use comma for multiple tags (ex: girl, boy, etc).', 'agrg') ?></p>

                        </fieldset>

                        <div class="hr-line"></div>

                        <div id="feat_image">

                            <label for="edit-field-category-und" class="control-label"><?php _e('Featured Image', 'agrg') ?></label>

                            <div class="option_item" id="featIMG">

                                <div class="my-account-author-image">

                                    <?php require_once(TEMPLATEPATH . '/inc/BFI_Thumb.php'); ?>

                                    <?php

                                    $params = array( 'width' => 130, 'height' => 130, 'crop' => true );

                                    echo "<img class='author-avatar' src='" . bfi_thumb( "$full_img_url", $params ) . "' alt='' />";

                                    ?>
                                </div>

                                <input class="featured-image-url" id="featured-image-url" type="text" size="36" name="featured-image-url" style="display: none;" value="" />
                                <input class="featured-image-id" id="featured-image-id" type="text" size="36" name="featured-image-id" style="display: none;" value="" />

                                <span class="full-width-button"><a href="#" class="upload-feat-image"><i class="fa fa-cloud-upload"></i><?php _e( 'Upload New Image', 'agrg' ); ?></a></span>
                                <span class="button_del_feat_image full-width-button"><i class="fa fa-trash-o"></i><?php _e( 'Delete Image', 'agrg' ); ?></span>

                                <script>
                                    var image_custom_uploader_feat;
                                    var $thisItem = '';

                                    jQuery(document).on('click','.upload-feat-image', function(e) {
                                        e.preventDefault();

                                        $thisItem = jQuery(this);

                                        //If the uploader object has already been created, reopen the dialog
                                        if (image_custom_uploader_feat) {
                                            image_custom_uploader_feat.open();
                                            return;
                                        }

                                        //Extend the wp.media object
                                        image_custom_uploader_feat = wp.media.frames.file_frame = wp.media({
                                            title: 'Choose Image',
                                            button: {
                                                text: 'Choose Image'
                                            },
                                            multiple: false
                                        });

                                        //When a file is selected, grab the URL and set it as the text field's value
                                        image_custom_uploader_feat.on('select', function() {
                                            attachment = image_custom_uploader_feat.state().get('selection').first().toJSON();
                                            var url = '';
                                            url = attachment['url'];
                                            var attachId = '';
                                            attachId = attachment['id'];
                                            $thisItem.parent().parent().find( "img.author-avatar" ).attr({
                                                src: url
                                            });
                                            $thisItem.parent().parent().find( ".featured-image-url" ).attr({
                                                value: url
                                            });
                                            $thisItem.parent().parent().find( ".featured-image-id" ).attr({
                                                value: attachId
                                            });
                                        });

                                        //Open the uploader dialog
                                        image_custom_uploader_feat.open();
                                    });

                                    jQuery(document).on('click','.button_del_feat_image', function(e) {
                                        jQuery(this).parent().parent().find( ".featured-image-url" ).attr({
                                            value: ''
                                        });
                                        jQuery(this).parent().parent().find( "img.author-avatar" ).attr({
                                            src: ''
                                        });
                                    });
                                </script>


                            </div>

                        </div>

                        <div class="hr-line"></div>

                        <div id="images_criteria">

                            <label for="edit-field-category-und" class="control-label"><?php _e('Images', 'agrg') ?></label>

                            <?php

                            $i = 0;

                            $attachments = get_children(array('post_parent' => $post->ID,
                                'post_status' => 'inherit',
                                'post_type' => 'attachment',
                                'post_mime_type' => 'image',
                                'order' => 'ASC',
                                'orderby' => 'menu_order ID'));

                            foreach($attachments as $att_id => $attachment) {

                            $full_img_url = wp_get_attachment_url($attachment->ID);
                            $full_img_id = $attachment->ID;

                            $i++;

                            ?>

                            <div class="option_item" id="<?php echo $i; ?>">

                                <div class="option_item" id="<?php echo $i; ?>">

                                    <div class="my-account-author-image">

                                        <?php require_once(TEMPLATEPATH . '/inc/BFI_Thumb.php'); ?>

                                        <?php

                                        $params = array( 'width' => 130, 'height' => 130, 'crop' => true );

                                        echo "<img class='author-avatar' src='" . bfi_thumb( "$full_img_url", $params ) . "' alt='' />";

                                        ?>
                                    </div>

                                    <input class="listing_image_url" id="listing_image_url<?php echo $i; ?>[0]" type="text" size="36" name="listing_image_url<?php echo $i; ?>[0]" style="display: none;" value="<?php echo $full_img_url; ?>" />
                                    <input class="listing_image_id" id="listing_image_url<?php echo $i; ?>[1]" type="text" size="36" name="listing_image_url<?php echo $i; ?>[1]" style="display: none;" value="<?php echo $full_img_id; ?>" />

                                    <span class="full-width-button"><a href="#" class="upload-author-image"><i class="fa fa-cloud-upload"></i><?php _e( 'Upload New Image', 'agrg' ); ?></a></span>
                                    <span class="button_del_image full-width-button"><i class="fa fa-trash-o"></i><?php _e( 'Delete Image', 'agrg' ); ?></span>

                                    <script>
                                        var image_custom_uploader;
                                        var $thisItem = '';

                                        jQuery(document).on('click','.upload-author-image', function(e) {
                                            e.preventDefault();

                                            $thisItem = jQuery(this);

                                            //If the uploader object has already been created, reopen the dialog
                                            if (image_custom_uploader) {
                                                image_custom_uploader.open();
                                                return;
                                            }

                                            //Extend the wp.media object
                                            image_custom_uploader = wp.media.frames.file_frame = wp.media({
                                                title: 'Choose Image',
                                                button: {
                                                    text: 'Choose Image'
                                                },
                                                multiple: false
                                            });

                                            //When a file is selected, grab the URL and set it as the text field's value
                                            image_custom_uploader.on('select', function() {
                                                attachment = image_custom_uploader.state().get('selection').first().toJSON();
                                                var url = '';
                                                url = attachment['url'];
                                                var attachId = '';
                                                attachId = attachment['id'];
                                                $thisItem.parent().parent().find( "img.author-avatar" ).attr({
                                                    src: url
                                                });
                                                $thisItem.parent().parent().find( ".listing_image_url" ).attr({
                                                    value: url
                                                });
                                                $thisItem.parent().parent().find( ".listing_image_id" ).attr({
                                                    value: attachId
                                                });
                                            });

                                            //Open the uploader dialog
                                            image_custom_uploader.open();
                                        });

                                        jQuery(document).on('click','.delete-author-image', function(e) {
                                            jQuery(this).parent().parent().find( ".listing_image_url" ).attr({
                                                value: ''
                                            });
                                            jQuery(this).parent().parent().find( "img.author-avatar" ).attr({
                                                src: ''
                                            });
                                        });
                                    </script>


                                </div>

                                <?php
                                }
                                ?>

                            </div>

                            <div id="template_image_criterion">

                                <div class="option_item" id="999">

                                    <div class="my-account-author-image">

                                        <?php require_once(TEMPLATEPATH . '/inc/BFI_Thumb.php'); ?>

                                        <?php

                                        $params = array( 'width' => 130, 'height' => 130, 'crop' => true );

                                        echo "<img class='author-avatar' src='" . bfi_thumb( "$full_img_url", $params ) . "' alt='' />";

                                        ?>
                                    </div>

                                    <input class="listing_image_url" id="" type="text" size="36" name="" style="display: none;" value="" />
                                    <input class="listing_image_id" id="" type="text" size="36" name="" style="display: none;" value="" />

                                    <span class="full-width-button"><a href="#" class="upload-author-image"><i class="fa fa-cloud-upload"></i><?php _e( 'Upload New Image', 'agrg' ); ?></a></span>
                                    <span class="button_del_image full-width-button"><i class="fa fa-trash-o"></i><?php _e( 'Delete Image', 'agrg' ); ?></span>

                                    <script>
                                        var image_custom_uploader;
                                        var $thisItem = '';

                                        jQuery(document).on('click','.upload-author-image', function(e) {
                                            e.preventDefault();

                                            $thisItem = jQuery(this);

                                            //If the uploader object has already been created, reopen the dialog
                                            if (image_custom_uploader) {
                                                image_custom_uploader.open();
                                                return;
                                            }

                                            //Extend the wp.media object
                                            image_custom_uploader = wp.media.frames.file_frame = wp.media({
                                                title: 'Choose Image',
                                                button: {
                                                    text: 'Choose Image'
                                                },
                                                multiple: false
                                            });

                                            //When a file is selected, grab the URL and set it as the text field's value
                                            image_custom_uploader.on('select', function() {
                                                attachment = image_custom_uploader.state().get('selection').first().toJSON();
                                                var url = '';
                                                url = attachment['url'];
                                                var attachId = '';
                                                attachId = attachment['id'];
                                                $thisItem.parent().parent().find( "img.author-avatar" ).attr({
                                                    src: url
                                                });
                                                $thisItem.parent().parent().find( ".listing_image_url" ).attr({
                                                    value: url
                                                });
                                                $thisItem.parent().parent().find( ".listing_image_id" ).attr({
                                                    value: attachId
                                                });
                                            });

                                            //Open the uploader dialog
                                            image_custom_uploader.open();
                                        });

                                        jQuery(document).on('click','.delete-author-image', function(e) {
                                            jQuery(this).parent().parent().find( ".listing_image_url" ).attr({
                                                value: ''
                                            });
                                            jQuery(this).parent().parent().find( "img.author-avatar" ).attr({
                                                src: ''
                                            });
                                        });
                                    </script>

                                </div>

                            </div>

                            <fieldset class="input-full-width">

                                <input class="listing_total_images" id="listing_total_images" type="text" size="36" name="listing_total_images" style="display: none;" value="" />

                                <button type="button" name="submit_add_image" id='submit_add_image' value="add" class="button-secondary"><i class="fa fa-plus-circle"></i> <?php _e( 'Add new image', 'agrg' ); ?></button>

                            </fieldset>

                            <div class="hr-line"></div>

                            <fieldset class="input-title">

                                <label for="edit-field-category-und" class="control-label"><?php _e('Video', 'agrg') ?></label>
                                <textarea name="video" id="video" cols="8" rows="5" ></textarea>
                                <p class="help-block"><?php _e('Add video embedding code here (youtube, vimeo, etc)', 'agrg') ?></p>

                            </fieldset>

                            <div class="hr-line"></div>

                            <?php

                            global $redux_demo;

                            $featured_ads_option = $redux_demo['featured-options-on'];

                            ?>

                            <?php if($featured_ads_option == 1) { ?>

                                <fieldset class="input-title">

                                    <label for="edit-field-category-und" class="control-label"><?php _e('Ad Type', 'agrg') ?></label>

                                    <?php if($featPlanMesage != '') { ?>
                                        <span class="error" style="color: #d20000; margin-bottom: 20px; font-size: 18px; font-weight: bold; float: left;"><?php echo $featPlanMesage; ?></span>
                                        <div class="clearfix"></div>
                                    <?php } ?>

                                    <div class="field-type-list-boolean field-name-field-featured field-widget-options-onoff form-wrapper" id="edit-field-featured">

                                        <?php

                                        global $current_user;
                                        get_currentuserinfo();

                                        $userID = $current_user->ID;

                                        $result = $wpdb->get_results( "SELECT * FROM wpcads_paypal WHERE user_id = $userID ORDER BY main_id DESC" );

                                        if ( $result ) {

                                            $featuredADS = 0;

                                            foreach ( $result as $info ) {
                                                if($info->status != "in progress" && $info->status != "pending" && $info->status != "failed") {


                                                    $featuredADS++;

                                                    if(empty($info->ads)) {
                                                        $availableADS = "Unlimited";
                                                        $infoAds = "Unlimited";
                                                    } else {
                                                        $availableADS = $info->ads - $info->used;
                                                        $infoAds = $info->ads;
                                                    }

                                                    if(empty($info->days)) {
                                                        $infoDays = "Unlimited";
                                                    } else {
                                                        $infoDays = $info->days;
                                                    }

                                                    if($info->used != "Unlimited" && $infoAds != "Ulimited" && $info->used == $infoAds) {

                                                    } else {

                                                        ?>

                                                        <label class="option checkbox control-label" for="edit-field-featured-und">
                                                            <input style="margin-right: 10px;" type="radio" id="edit-feature-plan" name="edit-feature-plan" value="<?php echo $info->main_id; ?>" class="form-checkbox" ><?php echo $infoAds; ?> <?php if($infoAds>1) { ?><?php _e( 'Ads', 'agrg' ); ?><?php } elseif($infoAds=="Unlimited") { ?><?php _e( 'Ads', 'agrg' ); ?><?php } elseif($infoAds==1) { ?><?php _e( 'Ad', 'agrg' ); ?><?php } ?> <?php _e( 'active for', 'agrg' ); ?> <?php echo $infoDays ?> <?php _e( 'days', 'agrg' ); ?> (<?php echo $availableADS; ?> <?php if($availableADS>1) { ?><?php _e( 'Ads', 'agrg' ); ?><?php } elseif($availableADS=="Unlimited") { ?><?php _e( 'Ads', 'agrg' ); ?><?php } elseif($availableADS==1) { ?><?php _e( 'Ad', 'agrg' ); ?><?php } ?> <?php _e( 'available', 'agrg' ); ?>)
                                                        </label>

                                                    <?php }
                                                }
                                            }
                                        }

                                        ?>

                                        <?php if($featuredADS != "0"){ ?>

                                            <label class="option checkbox control-label" for="edit-field-featured-und">
                                                <input style="margin-right: 10px;" type="radio" id="edit-feature-plan" name="edit-feature-plan" value="" class="form-checkbox" checked><?php _e( 'Regular', 'agrg' ); ?>
                                            </label>

                                        <?php } ?>

                                        <?php

                                        global $redux_demo;
                                        $featured_plans = $redux_demo['featured_plans'];

                                        ?>
                                        <?php if($featuredADS == "0" or empty($featuredADS)){ ?>
                                            <label class="option checkbox control-label" for="edit-field-featured-und">
                                                <input style="margin-right: 10px;" disabled="disabled" type="radio" id="edit-feature-plan" name="edit-feature-plan" value="" class="form-checkbox"><?php _e( 'Featured', 'agrg' ); ?>
                                            </label>
                                            <p><?php _e( 'Currently you have no active plan. You must purchase a', 'agrg' ); ?> <a href="<?php echo $featured_plans; ?>" target="_blank"><?php _e( 'Featured Pricing Plan', 'agrg' ); ?></a> <?php _e( 'to be able to publish a Featured Ad.', 'agrg' ); ?></p>
                                        <?php } ?>

                                    </div>

                                </fieldset>

                            <?php } ?>

                            <div class="hr-line"></div>

                            <div class="publish-ad-button">
                                <?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
                                <input type="hidden" name="submitted" id="submitted" value="true" />
                                <button class="btn form-submit" id="edit-submit" name="op" value="Publish Ad" type="submit"><?php _e('Publish Ad', 'agrg') ?></button>
                            </div>

                    </form>

                </div>

            </div>

            <div class="span3">

	    		<span class="ad-detail-info"><?php _e( 'Regular Ads', 'agrg' ); ?>
                    <span class="ad-detail"><?php echo $user_post_count = count_user_posts( $user_ID ); ?></span>
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

                    $wp_query->query('post_type=post&posts_per_page=-1&author='.$user_ID);

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

                    $result = $wpdb->get_results( "SELECT SUM(ads) AS sum FROM `wpcads_paypal`WHERE user_id = " . $current_user->ID);

                    $allads = $result[0]->sum;

                    $unlimited_ads = get_user_meta( $current_user->ID, 'unlimited', $single);

                    ?>

                    <span class="ad-detail-info"><?php _e( 'Featured Ads left', 'agrg' ); ?>
                        <span class="ad-detail"><?php if($unlimited_ads = "yes") { ?> ∞ <?php } else { echo $allads; } ?></span>
				</span>

                    <div class="pricing-plans">
                        <?php

                        global $redux_demo;
                        $featured_plans = $redux_demo['featured_plans'];

                        ?>
                        <a href="<?php echo $featured_plans; ?>" class="btn" style="margin-bottom: 30px;"><?php _e( 'See Featured Ads Plans', 'agrg' ); ?></a>
                    </div>

                <?php } ?>

                <div class="cat-widget" style="margin-top: 10px;">

                    <div class="cat-widget-title"><h4><?php _e( 'Most Popular', 'agrg' ); ?></h4></div>

                    <div class="cat-widget-content">

                        <ul>

                            <?php

                            global $paged, $wp_query, $wp;

                            $args = wp_parse_args($wp->matched_query);

                            if ( !empty ( $args['paged'] ) && 0 == $paged ) {

                                $wp_query->set('paged', $args['paged']);

                                $paged = $args['paged'];

                            }

                            $categories = get_the_category();
                            $cat_id = $categories[0]->cat_ID;


                            $current = -1;
                            $current2 = 0;


                            $popularpost = new WP_Query( array( 'posts_per_page' => '5', 'cat' => $cat_id, 'posts_type' => 'post', 'paged' => $paged, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );

                            while ( $popularpost->have_posts() ) : $popularpost->the_post(); $current++; $current2++;

                                ?>

                                <li class="widget-ad-list">


                                    <?php require_once(TEMPLATEPATH . '/inc/BFI_Thumb.php'); ?>

                                    <?php

                                    $thumb_id = get_post_thumbnail_id();
                                    $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);

                                    $params = array( 'width' => 48, 'height' => 48, 'crop' => true );
                                    echo "<img class='widget-ad-image' src='" . bfi_thumb( "$thumb_url[0]", $params ) . "'/>";

                                    ?>

                                    <span class="widget-ad-list-content">

						    			<span class="widget-ad-list-content-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>

                                        <?php $post_price = get_post_meta($post->ID, 'post_price', true); ?>
                                        <span class="add-price"><?php echo $post_price; ?></span>

						    		</span>

                                </li>

                            <?php endwhile; ?>

                        </ul>

                    </div>

                </div>

                <?php

                global $redux_demo;

                $featured_ads_option = $redux_demo['featured-options-on'];

                ?>

                <?php if($featured_ads_option == 1) { ?>

                    <div class="cat-widget" style="margin-top: 10px;">

                        <div class="cat-widget-title"><h4><?php _e( 'Featured Ads', 'agrg' ); ?></h4></div>

                        <div class="cat-widget-content">

                            <ul>

                                <?php

                                global $paged, $wp_query, $wp;

                                $args = wp_parse_args($wp->matched_query);

                                if ( !empty ( $args['paged'] ) && 0 == $paged ) {

                                    $wp_query->set('paged', $args['paged']);

                                    $paged = $args['paged'];

                                }

                                $categories = get_the_category();
                                $cat_id = $categories[0]->cat_ID;


                                $current = -1;
                                $featuredCurrent = 0;


                                $popularpost = new WP_Query( array( 'cat' => $cat_id, 'posts_type' => 'post', 'paged' => $paged, 'order' => 'DESC'  ) );


                                while ( $popularpost->have_posts() ) : $popularpost->the_post();

                                    $featured_post = get_post_meta($post->ID, 'featured_post', true);

                                    if($featured_post == "1") { $current++; $current2++; $featuredCurrent++;

                                        if($featuredCurrent < 5) { ?>

                                            <li class="widget-ad-list">


                                                <?php require_once(TEMPLATEPATH . '/inc/BFI_Thumb.php'); ?>

                                                <?php

                                                $thumb_id = get_post_thumbnail_id();
                                                $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);

                                                $params = array( 'width' => 48, 'height' => 48, 'crop' => true );
                                                echo "<img class='widget-ad-image' src='" . bfi_thumb( "$thumb_url[0]", $params ) . "'/>";

                                                ?>

                                                <span class="widget-ad-list-content">

								    			<span class="widget-ad-list-content-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>

                                                    <?php $post_price = get_post_meta($post->ID, 'post_price', true); ?>
                                                    <span class="add-price"><?php echo $post_price; ?></span>

								    		</span>

                                            </li>

                                        <?php } ?>

                                    <?php } ?>

                                <?php endwhile; ?>

                            </ul>

                        </div>

                    </div>

                <?php } ?>

                <?php //get_sidebar('pages'); ?>

            </div>

        </div>

    </section>