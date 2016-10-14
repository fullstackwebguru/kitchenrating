<?php

use yii\helpers\Html;
use yii\helpers\Url;

use frontend\widgets\Rating;
?>

<div class="featured_product_section">
  <div class="feature_pruducts">
    <div class="container">
      <div class="feature_pruducts_inner">
        <h2 class="section_title">Featured Products</h2>
          <?php
          $i =0;
          $tagOppend = false;
          foreach ($featuredProducts as $product) {

            if ($i==3) { $i=0; $tagOppend = false; ?>
            </div>
            <?php } 

            if ($i == 0) { $tagOppend = true; ?>
              <div class="row products_row">
          <?php }

          ?>
          <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="single_product_cell">
              <h2>
                <?=  Html::a($product->title, $product->getRoute()) ?>
              </h2>
              <span><?= $product->sku?></span>
              <div class="media">
                <div class="media-left">
                  <a href="<?=Url::toRoute($product->getRoute())?>">
                    <span>Deal</span>
                    <?= Yii::$app->imageCache->img('@mainUpload/' . $product->getMainImage()->image_url, '130x130', ['class' => 'file-preview-image']) ?>
                  </a>
                </div>
                <div class="media-body">
                  <h2>#02</h2>
                  <h3>in <?=$product->category->title?></h3>
                  <?= Rating::widget(['rating' => $product->rating]) ?>
                  <p>Based on <?= $product->num_rating ?> ratings</p>

                  <?=  Html::a('View Top 10 ' . $product->category->title, $product->category->getRoute(), ['class'=>'readmore']) ?>
                </div>
              </div>
            </div>
          </div>
        <?php
            $i++;
            }
           ?>

         <?php if ($tagOppend ==true) { ?>
            </div>
        <?php } ?>
        <!-- <div class="clearfix text-center ">
          <a href="#" class="btn btn-default btn_common">SHOW MORE</a>
        </div> -->
      </div>
    </div>
  </div>
</div>