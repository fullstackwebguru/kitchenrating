<?php

/* @var $this yii\web\View */

use frontend\widgets\LatestGuide;

$this->title = 'Kitchen Rating';
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
      <div class="signup_box">
        <label>Get latest deals in inbox</label>
        <div class="input_box">
          <input type="text" placeholder="SUBSCRIBE NEWSLETTER" class="form-control">
          <button class="signup_btn">SIGNUP</button>
        </div>
      </div>
    </div>
    <div class="pull-left">
      <div class="footer_social">
        <p>Follow KitchenRatings.com</p>
        <div>
          <a href="#"><span class="fa fa-facebook"></span></a>
          <a href="#"><span class="fa fa-twitter"></span></a>
          <a href="#"><span class="fa fa-google-plus"></span></a>
        </div>
      </div>
    </div>
  </div>
</div>