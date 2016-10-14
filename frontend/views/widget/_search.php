<?php 
use yii\helpers\Html;
use yii\helpers\Url;

use frontend\widgets\Rating;
?>

<div>
  <?php foreach($top10s as $category) { ?>
      <a href="<?= Url::toRoute($category->getRoute())?>" class="media single_ten_products">
        <div class="pull-left">              
          <?= Yii::$app->imageCache->img('@mainUpload/' . $category->image_url, '50x50', ['class' => 'file-preview-image']) ?>
        </div>
        <div>
          <?= Rating::widget(['rating' => $category->rating]) ?>
          <span class="rate_title"><?=$category->num_rating?> ratings</span>
          <?=$category->title?>
        </div>
      </a>
  <?php } ?>
</div>