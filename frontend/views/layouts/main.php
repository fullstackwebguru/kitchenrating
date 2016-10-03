<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="home" id="site_body">
<?php $this->beginBody() ?>

<a href="#site_body" class="go_to_top">
  <i class="fa fa-angle-up"></i>
</a>
<div class="social_share">
  <a href="">
    <span>Facebook</span>
    <i class="fa fa-facebook"></i>
  </a>
  <a href="">
    <span>Twitter</span>
    <i class="fa fa-twitter"></i>
  </a>
  <a href="">
    <span>Facebook</span>
    <i class="fa fa-facebook"></i>
  </a>
  <a href="">
    <span>Twitter</span>
    <i class="fa fa-twitter"></i>
  </a>
</div>
<div class="site_wraper">

    <?= $content ?>

    <div class="footer">
        <div class="container">
            <div class="pull-right">
                <ul class="nav nav-pills">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">ToS</a></li>
                    <li><a href="#">Disclamer</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="pull-left">
                <p class="copy_right">&copy; Copyright 2016 KitchenRatings. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
