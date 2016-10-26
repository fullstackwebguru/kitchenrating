<?php

/* @var $this yii\web\View */

use frontend\widgets\LatestGuide;
use frontend\widgets\NewsletterBox;

$this->title = $model->title;

$this->registerMetaTag([
            'name'=>'keywords',
            'content' => $model->meta_keywords
        ]);

$this->registerMetaTag([
            'name'=>'description',
            'content' => $model->meta_description
        ]);

?>
    
    <?= $this->render('_banner', [
        
    ]) ?>

    <?= $this->render('_featured', [
        'featuredProducts' => $featuredProducts
    ]) ?>

    <?= $this->render('_top10', [
        'popularTop10' => $popularTop10
    ]) ?>

    <?= LatestGuide::widget(); ?>

<div class="subscriber_section">
  <div class="container">
    <div class="pull-right">
      <?= NewsletterBox::widget(['type' => 'footer']); ?>
    </div>
    <div class="pull-left">
      <div class="footer_social">
        <p>Follow KitchenRatings.com</p>
        <div>
          <a href="https://facebook.com/share.php?u=https://kitchenrating.com&title=<?=$this->title?>" class="btnShare"><span class="fa fa-facebook"></span></a>
          <a href="https://twitter.com/intent/tweet?status=<?=$this->title?>+https://kitchenratings.com" class="btnShare"><span class="fa fa-twitter"></span></a>
          <a href="https://plus.google.com/share?url=https://kitchenratings.com" class="btnShare"><span class="fa fa-google-plus"></span></a>
        </div>
      </div>
    </div>
  </div>
</div>