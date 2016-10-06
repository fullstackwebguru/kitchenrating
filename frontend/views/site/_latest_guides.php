<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="latest_guided_section">
  <div class="latest_guided_box">
    <div class="container">
      <h2 class="section_title">Latest Guides</h2>
      <div class="row">
        <?php
          foreach ($guides as $guide) {
        ?>
        <div class="col-xs-12 col-sm-3">
          <div class="single_guided_box">
            <a href="<?= Url::toRoute($guide->getRoute())?>" class="img_thumb">
              <?= Yii::$app->imageCache->img('@mainUpload/' . $guide->image_url, '130x130', ['class' => 'file-preview-image']) ?>
            </a>
            <?=  Html::a($guide->title, $guide->getRoute(), ['class' => 'guide_title']) ?>
          </div>
        </div>
        <?php
          }
        ?>
      </div>
      <div class="text-right">
        <?= Html::a('View more guides&nbsp;&nbsp;>>',['/guide'], ['class' => 'read_more_guide']) ?>
      </div>
    </div>
  </div>
</div>