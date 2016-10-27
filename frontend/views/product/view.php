<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\widgets\RecentTop10;
use yii\helpers\Url;
use kartik\markdown\Markdown;
use frontend\widgets\Rating;
use frontend\widgets\SearchBox;

$this->title = 'Product -' . $model->title;
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag([
            'name'=>'keywords',
            'content' => $model->meta_keywords
        ]);

$this->registerMetaTag([
            'name'=>'description',
            'content' => $model->meta_description
        ]);
        
?>


<div class="product_single_page_details">
	<div class="container">
	  <div class="row rs_bread_crumb_back">
	    <div class="col-xs-12 col-sm-6">
	      <div class="bread_crumb">
	        <ul>
	          <li><?=  Html::a('Home',['/']) ?></li>
	          <li><span>/</span></li>
	          <li><?=  Html::a( $model->category->title ,$model->category->getRoute()) ?></li>
	          <li><span>/</span></li>
	          <li><strong><?= $model->title ?></strong></li>
	        </ul>
	      </div>
	    </div>
	    <div class="col-xs-12 col-sm-6">
	      <a href="<?= Url::toRoute($model->category->getRoute()) ?>" class="back_to_10">
		      <i> &lt; </i>
		      back to <span>TOP10</span>  best <?= $model->category->title ?>
		  </a>
	    </div>
	  </div>
	  <div class="single_product_content">
	    <div class="row">
	      <div class="col-xs-12 col-sm-5">
	        <div class="product_images">
        	<?php 
				if ($model->productImages  && count($model->productImages)>0) {

					$mainImage = $model->productImages[0];
					$mainImg = cloudinary_url($mainImage->image_url, array("width" => 550, "height" => 550, "crop" => "fill"));
			?>
				
	          <a href="<?= $mainImg ?>" data-rel="prettyPhoto[pp_gal]"  class="big_img">
	            <img src="<?= $mainImg ?>" alt="title" id="rs_zoom_img"  data-zoom-image="<?= $mainImg ?>">
	          </a>
	          <div class="owl-carousel owl-theme product_gallery">
	          	<?php 
					foreach($model->productImages as $pImage) {
						$smImg = cloudinary_url($pImage->image_url, array("width" => 550, "height" => 550, "crop" => "fill"));
						$mainImg = cloudinary_url($pImage->image_url, array("width" => 113, "height" => 113, "crop" => "fill"));
	          	?>
	            <a href="#" data-sm-img="<?= $smImg ?>" data-lg-img="<?= $smImg ?> "><img  src="<?= $mainImg ?>" alt="tilte"></a>
	            <?php
	            }
	            ?>
	            
	          </div>
	         <?php	
					}		
			 ?>
	        </div>
	      </div>
	      <div class="col-xs-12 col-sm-7">
	        <a href="#" class="title"><?= $model->title ?> 3</a>
	        <span class="product_code"><?= $model->sku ?> </span>
	        <div class="rate_and_color">
	          <div class="p_colors">
	            <span>color options</span>
	            <div>
	              <a href="javascript:void(0)" style="background:<?= $model->color ?>"></a>
	              <?php 
	              	foreach ($model->productColors as $color)  {
	              ?>
	              	<a href="javascript:void(0)" style="background:<?= $color->color ?>"></a>
	              <?php 
	              	}
	              ?>
	            </div>
	          </div>
	          <div class="rate_back">
	            <?= Rating::widget(['rating' => $model->rating]) ?>
	            <span class="rate_title"><?= $model->num_rating ?> ratings</span>
	          </div>
	        </div>
	        <div class="separator"></div>
	        <div class="do_shop_links">
	          <div class="row">
	            <div class="col-xs-12 col-sm-6">
	              <img src="<?= $model->store->image_url ?>" alt="<?= $model->store->title ?>">
	            </div>
	            <div class="col-xs-12 col-sm-6">
	              <a href="<?= $model->product_url ?>" class="btn btn-default btn_common btn_yellow"><i>>></i>SHOP</a>
	            </div>
	          </div>
	        </div>
	        <div class="separator"></div>
	        <div class="details_text">
	          	<?= Markdown::convert($model->description) ?>
	        </div>
	      </div>
	    </div>
	    
	    <div class="separator"></div>

	    <?php 

	    if (count($model->productInfos) > 0 ) {
	    ?>
	    <div class="buying_options_cmp">
          <h2>Compare buying options</h2>
          <div class="do_shop_links">
          <?php
          foreach($model->productInfos as $info) {
          ?>
            <div class="row">
              <div class="col-xs-12 col-sm-5">
                <strong><?= $model->title ?></strong>
              </div>
              <div class="col-xs-12 col-sm-3">
                <img src="<?= $info->store->image_url ?>" alt="<?= $info->store->title ?>">
              </div>
              <div class="col-xs-12 col-sm-4">
                <a href="<?= $info->product_url ?>" class="btn btn-default btn_common btn_yellow">SHOP >></a>
              </div>
            </div>
          <?php
		      }
          ?>

          </div>
        </div>
        <div class="separator"></div>

        <?php 
    	}
        ?>

	  </div>
	  
	  <a href="<?= Url::toRoute($model->category->getRoute()) ?>" class="back_to_10">
	      <i> &lt; </i>
	      back to <span>TOP10</span>  best <?= $model->category->title ?>
	  </a>

	  <div class="search_box">
	      <h2>search for more products</h2>
	      <div class="search_form">
	      	<?= SearchBox::widget(['type'=>'product']) ?>
	        <div class="clear_fix"></div>
	      </div>
	    </div>

	  <div class="clearfix"></div>
	</div>


	<div class="text-center more_10_items_list_section">
	<div class="container-fluid">
	<?=RecentTop10::widget()?>
	</div>
	</div>
	
</div>