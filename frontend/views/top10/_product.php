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
          <?= Yii::$app->imageCache->img('@mainUpload/' . $product->getMainImage()->image_url, '165x170') ?>
        </a>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-5">
        <div class="product_contents">
          <?=  Html::a($product->title, $product->getRoute(), ['class' => 'title']) ?>
          <span class="product_meta">500W 12500RPM</span>
          <?= Rating::widget(['rating' => $product->rating]) ?>
          <span class="rate_title"><?= $product->num_rating ?> ratings</span>
          <div class="product_progress">
            <div class="sinlge_progress">
              <h5>Price</h5>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%"></div>
              </div>
            </div>
            <div class="sinlge_progress">
              <h5>Quality</h5>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%"></div>
              </div>
            </div>
            <div class="sinlge_progress">
              <h5>Trust in brand</h5>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-2 col-md-1">
        <div class="score_board">
          <span>Score</span>
          <h2>9.58</h2>
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