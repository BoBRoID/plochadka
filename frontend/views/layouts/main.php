<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

$header_version = 2;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<section id="top-menu-block">
    <div class="container">
        <section id="register-login-block-top">
            <ul class="ajax-register-links inline">
                <?php
                if (!\Yii::$app->user->isGuest){ ?>
                <li class="first">
                    <a href="/account" class="ctools-use-modal ctools-modal-ctools-ajax-register-style" title="Login"><?=\Yii::t('site', 'Мой аккаунт')?></a>
                </li>
                <li class="last">
                    <a href="/logout" class="ctools-use-modal ctools-modal-ctools-ajax-register-style" title="Logout"><?=\Yii::t('site', 'Выйти')?></a>
                </li>
                <?php } else { ?>
                    <li class="first">
                        <a href="/login" class="ctools-use-modal ctools-modal-ctools-ajax-register-style" title="Login"><?=\Yii::t('site', 'Войти')?></a>
                    </li>
                    <li class="last">
                        <a href="/register" class="ctools-use-modal ctools-modal-ctools-ajax-register-style" title="Register"><?=\Yii::t('site', 'Регистрация')?></a>
                    </li>
                <?php } ?>
                </ul>
            </section>
            <div class="top-social-icons">
                <?php if(!empty($facebook_link)) { ?>
                    <a class="target-blank" href="<?php echo $facebook_link; ?>"><i class="fa fa-facebook-square"></i></a>
                <?php } ?>

                <?php if(!empty($twitter_link)) { ?>
                    <a class="target-blank" href="<?php echo $twitter_link; ?>"><i class="fa fa-twitter-square"></i></a>
                <?php } ?>

                <?php if(!empty($dribbble_link)) { ?>
                    <a class="target-blank" href="<?php echo $dribbble_link; ?>"><i class="fa fa-dribbble"></i></a>
                <?php } ?>

                <?php if(!empty($flickr_link)) { ?>
                    <a class="target-blank" href="<?php echo $flickr_link; ?>"><i class="fa fa-flickr"></i></a>
                <?php } ?>

                <?php if(!empty($github_link)) { ?>
                    <a class="target-blank" href="<?php echo $github_link; ?>"><i class="fa fa-github-square"></i></a>
                <?php } ?>

                <?php if(!empty($pinterest_link)) { ?>
                    <a class="target-blank" href="<?php echo $pinterest_link; ?>"><i class="fa fa-pinterest-square"></i></a>
                <?php } ?>

                <?php if(!empty($youtube_link)) { ?>
                    <a class="target-blank" href="<?php echo $youtube_link; ?>"><i class="fa fa-youtube-square"></i></a>
                <?php } ?>

                <?php if(!empty($google_plus_link)) { ?>
                    <a class="target-blank" href="<?php echo $google_plus_link; ?>"><i class="fa fa-google-plus-square"></i></a>
                <?php } ?>

                <?php if(!empty($linkedin_link)) { ?>
                    <a class="target-blank" href="<?php echo $linkedin_link; ?>"><i class="fa fa-linkedin-square"></i></a>
                <?php } ?>

                <?php if(!empty($tumblr_link)) { ?>
                    <a class="target-blank" href="<?php echo $tumblr_link; ?>"><i class="fa fa-tumblr-square"></i></a>
                <?php } ?>

                <?php if(!empty($vimeo_link)) { ?>
                    <a class="target-blank" href="<?php echo $vimeo_link; ?>"><i class="fa fa-vimeo-square"></i></a>
                <?php } ?>
            </div>
        </div>
    </section>

<header id="navbar">
    <div class="container">
        <a class="logo pull-left" href="/" title="Home">
            <img src="<?=!empty(\Yii::$app->params['logo']) ? \Yii::$app->params['logo'] : '/images/logo.png'?>" alt="Logo" />
        </a>

        <div id="version-two-menu" class="main_menu">
            <?=\common\widgets\TopMenu::widget()?>
            <?php //wp_nav_menu(array('theme_location' => 'primary', 'container' => 'false')); ?>
        </div>

        <section id="new-post" class="block block-crystal-block" style="margin-top: 13px !important">
            <a href="/createpost" class="btn button"><?=\Yii::t('site', 'Разместить обьявление!')?></a>
        </section>
        </div>
</header>
<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<?= Alert::widget() ?>
<?= $content ?>
<footer class="footer">
    <div class="container">
        <div class="full">

        </div>
    </div>
</footer>

<section class="socket">
    <div class="container">
        <div class="site-info">
            @ <?= date('Y') ?> by <a class="target-blank" href="#">Some</a>
        </div>
        <div class="footer_menu">
            <?php //wp_nav_menu(array('theme_location' => 'secondary', 'container' => 'false')); ?>
        </div>
        <div class="backtop">
            <a href="#backtop"><i class="fa fa-chevron-up"></i></a>
        </div>
    </div>
</section>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
