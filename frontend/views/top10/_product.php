<?php 

use frontend\widgets\Rating;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<!-- Start single list -->
  <div class="product_single_list">
    <div class="row">
      <div class="col-xs-12 col-sm-1">
        <div class="product_number"><?= $rank ?></div>
      </div>
      <div class="col-xs-12 col-sm-2">
        <a href="<?=Url::toRoute($product->getRoute())?>" class="product_thumb">
        <img src="<?= cloudinary_url($product->getMainImage() ? $product->getMainImage()->image_url : '', array("width" => 165, "height" => 180, "crop" => "fill")) ?>" >
        </a>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-5">
        <div class="product_contents">
          <?=  Html::a($product->title, $product->getRoute(), ['class' => 'title']) ?>
          <span class="product_meta"><?= $product->sku ?></span>
          <?= Rating::widget(['rating' => $product->rating]) ?>
          <span class="rate_title"><?= $product->num_rating ?> ratings</span>
          <div class="product_progress">
            <div class="sinlge_progress">
              <h5><?= $product->category->rank_option1 ?></h5>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?=$product->rank_option1?>" aria-valuemin="0" aria-valuemax="10" style="width:<?=$product->rank_option1 * 10 ?>%"></div>
              </div>
            </div>
            <div class="sinlge_progress">
              <h5><?= $product->category->rank_option2 ?></h5>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?=$product->rank_option2?>" aria-valuemin="0" aria-valuemax="10" style="width:<?=$product->rank_option2 * 10 ?>%"></div>
              </div>
            </div>
            <div class="sinlge_progress">
              <h5><?= $product->category->rank_option3 ?></h5>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?=$product->rank_option3?>" aria-valuemin="0" aria-valuemax="10" style="width:<?=$product->rank_option3 * 10 ?>%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-2 col-md-1">
        <div class="score_board">
          <span>Score</span>
          <h2><?= $product->score ?></h2>
        </div>
      </div>
      <div class="col-xs-12 col-sm-3">
        <div class="top_10_buttons_group">
          <a href="<?=Url::toRoute($product->getRoute())?>" class="btn btn-default btn_common btn_yellow btn_img">View</a>
        </div>
      </div>
    </div>
  </div>
  <!-- end single list -->