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
  <a href="https://facebook.com/share.php?u=https://kitchenrating.com&title=<?=$this->title?>" class="btnShare">
    <span>Facebook</span>
    <i class="fa fa-facebook"></i>
  </a>
  <a href="https://twitter.com/intent/tweet?status=<?=$this->title?>+https://kitchenratings.com" class="btnShare">
    <span>Twitter</span>
    <i class="fa fa-twitter"></i>
  </a>
  <a href="https://plus.google.com/share?url=https://kitchenratings.com" class="btnShare">
    <span>Facebook</span>
    <i class="fa fa-google"></i>
  </a>
</div>

<div class="site_wraper">

    <?= $this->render(
        'header.php'
    ) ?>

    <?= $content ?>

    <?= $this->render(
        'footer.php'
    ) ?>   
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
