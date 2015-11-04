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


    <section id="ads-category-content">
        <div class="container">
            <div class="span9 first">
                <?=\yii\bootstrap\Tabs::widget([
                    'items' =>  [
                        [
                            'label'     =>  \Yii::t('site', 'Latest Ads'),
                            'content'   =>  $this->render('_latest_ads', [
                                'category'  =>  $category->id
                            ])
                        ],
                        [
                            'label'     =>  \Yii::t('site', 'Most Popular Ads'),
                            'content'   =>  $this->render('_popular_ads', [
                                'category'  =>  $category->id
                            ])
                        ],
                        [
                            'label'     =>  \Yii::t('site', 'Random Ads'),
                            'content'   =>  $this->render('_random_ads', [
                                'category'  =>  $category->id
                            ])
                        ],
                    ]
                ])?>
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
                                    <span class="category-counter"><?php //echo $category->count ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php// get_sidebar('pages'); ?>
            </div>
        </div>
    </section>

    <script>
        $.(function() {
            $.("ul.tabs").tabs("> .pane", {effect: 'fade', fadeIn: 200});
        });
    </script>