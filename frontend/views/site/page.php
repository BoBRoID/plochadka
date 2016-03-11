<div id="advanced-search-widget-version2">
    <div class="container">
        <div class="advanced-search-widget-content">
            <form action="/" method="get" id="views-exposed-form-search-view-other-ads-page" accept-charset="UTF-8">
                <div id="edit-search-api-views-fulltext-wrapper" class="views-exposed-widget views-widget-filter-search_api_views_fulltext">
                    <div class="views-widget">
                        <div class="control-group form-type-textfield form-item-search-api-views-fulltext form-item">
                            <div class="controls">
                                <input placeholder="<?=\Yii::t('site', 'Введите ключевые слова...')?>" type="text" id="edit-search-api-views-fulltext" name="s" value="" size="30" maxlength="128" class="form-text">
                            </div>
                        </div>
                    </div>
                </div>

                <div id="edit-ad-location-wrapper" class="views-exposed-widget views-widget-filter-field_ad_location">
                    <div class="views-widget">
                        <div class="control-group form-type-select form-item-ad-location form-item">
                            <div class="controls">
                                <select id="edit-ad-location" name="post_location" class="form-select" style="display: none;">
                                    <option value="All" selected="selected"><?=\Yii::t('site', 'Местоположение...')?></option>

                                    <?php
                                    /*
                                    $args_location = array( 'posts_per_page' => -1 );
                                    $lastposts = get_posts( $args_location );

                                    $all_post_location = array();
                                    foreach( $lastposts as $post ) {
                                        $all_post_location[] = get_post_meta( $post->ID, 'post_location', true );
                                    }

                                    $directors = array_unique($all_post_location);
                                    foreach ($directors as $director) { ?>
                                        <option value="<?php echo $director; ?>"><?php echo $director; ?></option>
                                    <?php }
                                    */
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="edit-field-category-wrapper" class="views-exposed-widget views-widget-filter-field_category">
                    <div class="views-widget">
                        <div class="control-group form-type-select form-item-field-category form-item">
                            <div class="controls">
                                <select id="edit-field-category" name="category_name" class="form-select" style="display: none;">

                                    <option value="All" selected="selected"><?php\Yii::t('site', 'Категория')?></option>
                                    <?php
                                    /*
                                    $args = array(
                                        'hierarchical' => '0',
                                        'hide_empty' => '0'
                                    );
                                    $categories = get_categories($args);
                                    foreach ($categories as $cat) {
                                        if ($cat->category_parent == 0) {
                                            $catID = $cat->cat_ID;
                                            ?>
                                            <option value="<?php echo $cat->cat_name; ?>"><?php echo $cat->cat_name; ?></option>

                                            <?php
                                            $args2 = array(
                                                'hide_empty' => '0',
                                                'parent' => $catID
                                            );
                                            $categories = get_categories($args2);
                                            foreach ($categories as $cat) { ?>
                                                <option value="<?php echo $cat->cat_slug; ?>">- <?php echo $cat->cat_name; ?></option>
                                            <?php } ?>

                                        <?php }
                                    }

                                    */
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="advanced-search-slider">
                    <div class="geo-location-button">
                        <div class="geo-location-switch off"><i class="fa fa-location-arrow"></i></div>
                    </div>

                    <div id="advance-search-slider" class="value-slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
                        <a class="ui-slider-handle ui-state-default ui-corner-all" href="#">
                            <span class="range-pin">
                                <input type="text" name="geo-radius" id="geo-radius" value="100" data-default-value="100">
                            </span>
                        </a>
                    </div>
                </div>


                <input type="text" name="geo-location" id="geo-location" value="off" data-default-value="off">
                <input type="text" name="geo-radius-search" id="geo-radius-search" value="500" data-default-value="500">
                <input type="text" name="geo-search-lat" id="geo-search-lat" value="0" data-default-value="0">
                <input type="text" name="geo-search-lng" id="geo-search-lng" value="0" data-default-value="0">


                <div class="views-exposed-widget views-submit-button">
                    <button class="btn btn-primary form-submit" id="edit-submit-search-view" name="" value="Search" type="submit"><?=\Yii::t('site', 'Поиск')?></button>
                </div>

            </form>

        </div>

    </div>

</div>