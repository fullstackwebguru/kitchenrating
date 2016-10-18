<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'All guides';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="all_guides_arcive">
	<div class="container">
	  <div class="bread_crumb">
	    <ul>
	      <li>
	      	<?=  Html::a('Home',['/']) ?>
	      </li>
	      <li><span>/</span></li>
	      <li><strong>All guides</strong></li>
	    </ul>
	  </div>
	  <div class="all_guides_list">
	    <div class="row">
	    <?php
          foreach ($guides as $guide) {
        ?>
	      <div class="col-xs-12 col-sm-3">
	        <a href="<?= Url::toRoute($guide->getRoute())?>" class="all_guides_list_single">
	        <img src="<?= cloudinary_url($guide->image_url, array("width" => 211, "height" => 141, "crop" => "fill")) ?>" class="file-preview-image">
	          <div class="desc">
	            <h2><?= $guide->title ?></h2>
	            <p><?= $guide->meta_description ?></p>
	            <div class="meta">
	              <strong><?= $guide->author?></strong>
	              <span><?= Yii::$app->formatter->asDate($guide->created_at, 'long'); ?></span>
	            </div>
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