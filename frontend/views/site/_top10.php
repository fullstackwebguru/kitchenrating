<?php

use yii\helpers\Html;
use yii\helpers\Url;

use frontend\widgets\Rating;
?>

<div class="popular_ten_products_section">
  <div class="container">
    <div class="popular_ten_products">
      <h2 class="section_title">Popular 10 products</h2>
      <div class="row">

        <?php
          foreach ($popularTop10 as $category) {
        ?>

        <div class="col-xs-12 col-sm-4">
          <a href="<?= Url::toRoute($category->getRoute())?>" class="media single_ten_products">
            <div class="media-left">              
              <img src="<?= cloudinary_url($category->image_url, array("width" => 136, "height" => 142, "crop" => "fill")) ?>" class="file-preview-image">
            </div>
            <div class="media-body">
              <?= Rating::widget(['rating' => $category->rating]) ?>
              <span class="rate_title"><?=$category->num_rating?> ratings</span>
              <h2>
                <span>Best</span>
                top 10
              </h2>
              <h3>in <?=$category->title?> <span>2016</span></h3>
              <p>>></p>
            </div>
          </a>
        </div>
      
      <?php
          }
      ?>
      </div>
    </div>
  </div>
</div>