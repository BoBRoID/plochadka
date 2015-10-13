<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 13.10.15
 * Time: 13:01
 */

$this->title = \Yii::t('site', 'Регистрация');

?>
<section id="ad-page-title" class="add-new-post-header" >
    <div class="container">
        <div class="span9 first">
            <h2><?=$this->title?></h2>
        </div>
    </div>
</section>

<section class="ads-main-page">
    <div class="container">
        <div class="span9 first">
            <div id="edit-profile" class="ad-detail-content">
                <div class="one_half first">
                    <?php $form = new \yii\bootstrap\ActiveForm([
                        'options'   =>  [
                            'class' =>  'form-item',
                            'id'    =>  'primaryPostForm'
                        ],
                        'fieldConfig' => [
                            'inputOptions'  =>  [
                                'class' =>  'text',
                                'style' =>  'height: auto'
                            ],
                            'options'   =>  [
                                'tag'   =>  'fieldset',
                                'class' =>  'input-title'
                            ],
                            'template' => "{label}\n{input}<div style=\"width: 90%\">{hint}\n{error}</div>",
                            'horizontalCssClasses' => [
                                'label' => '',
                                'offset' => '',
                                'wrapper' => '',
                                'error' => '',
                                'hint' => '',
                            ],
                        ],
                    ]);
                    $form->begin();
                    ?>
                    <?=$form->field($model, 'username')?>
                    <?=$form->field($model, 'email')?>
                    <?=$form->field($model, 'password')->passwordInput()?>
                    <?=$form->field($model, 'password2')->passwordInput()?>
                    <div class="hr-line"></div>

                    <div class="publish-ad-button">
                        <button class="btn form-submit" id="edit-submit" name="op" value="<?=\Yii::t('site', 'Publish Ad')?>" type="submit"><?=\Yii::t('site', 'Зарегистрироваться')?></button>
                    </div>
                    <?php $form->end()?>
                </div>
                <?php if(\Yii::$app->params['enableSocialAuth']){ ?>
                <div class="one_half social-links">
                    <div class="register-page-title">
                        <?=\Yii::t('site', 'Войти через социальные сети')?>
                    </div>

                        <?php
                        /**
                         * Detect plugin. For use on Front End only.
                         */
                        //include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

                        // check for plugin using plugin name
                        if ( false){//is_plugin_active( "nextend-facebook-connect/nextend-facebook-connect.php" ) ) {
                            //plugin is activated

                            ?>

                            <fieldset class="input-full-width">

                                <a class="register-social-button-facebook" href="<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;"><i class="fa fa-facebook-square"></i> Facebook</a>

                            </fieldset>

                        <?php } ?>

                        <?php
                        /**
                         * Detect plugin. For use on Front End only.
                         */
                        //include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

                        // check for plugin using plugin name
                        if ( false){//is_plugin_active( "nextend-twitter-connect/nextend-twitter-connect.php" ) ) {
                            //plugin is activated

                            ?>

                            <fieldset class="input-full-width">

                                <a class="register-social-button-twitter" href="<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginTwitter=1&redirect='+window.location.href; return false;"><i class="fa fa-twitter-square"></i> Twitter</a>

                            </fieldset>

                        <?php } ?>

                        <?php
                        /**
                         * Detect plugin. For use on Front End only.
                         */
                        //include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

                        // check for plugin using plugin name
                        if ( false){//is_plugin_active( "nextend-google-connect/nextend-google-connect.php" ) ) {
                            //plugin is activated

                            ?>

                            <fieldset class="input-full-width">

                                <a class="register-social-button-google" href="<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1" onclick="window.location = '<?php echo get_site_url(); ?>/wp-login.php?loginGoogle=1&redirect='+window.location.href; return false;"><i class="fa fa-google-plus-square"></i> Google</a>

                            </fieldset>

                        <?php } ?>

                    <div class="publish-ad-button">
                        <p>
                            <?=\yii\helpers\Html::a(\Yii::t('site', 'Войти'), \yii\helpers\Url::toRoute('login'))?>
                        </p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="span3">
            <?php //get_sidebar('pages'); ?>
        </div>
    </div>
</section>