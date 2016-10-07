<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

use frontend\widgets\Rating;
use frontend\widgets\RecentTop10;

use frontend\assets\Top10JsAsset;

$this->title = 'Top 10 - '. $model->title;
$this->params['breadcrumbs'][] = $this->title;

Top10JsAsset::register($this);
?>

<div class="bg_image_section">
	<div class="bg_image_overly text-center">
	  <div class="container">
	    <div class="page_banner_title">
	      <h1>Top 10</h1>
	      <h2><?= $model->title ?></h2>
	    </div>
	  </div>
	  <div class="price_range_filter_section">
	    <div class="container">
	      <h2>What do you care about?</h2>
	      <p>drag + or - if you care more or less</p>
	      <div class="row">
	        <div class="col-xs-12 col-sm-4">
	          <div class="rs_price_filter">
	            <h2 class="filter_title">Price</h2>
	            <div class="rs_filter_group">
	              <div class="rs_filter_dec"><i class="fa fa-minus" aria-hidden="true"></i></div>
	              <div class="rs_filter" data-value="20" data-key="price_level"></div>
	              <div class="rs_filter_inc"><i class="fa fa-plus" aria-hidden="true"></i></div>
	            </div>
	          </div>
	        </div>
	        <div class="col-xs-12 col-sm-4">
	          <div class="rs_price_filter">
	            <h2 class="filter_title">Quality</h2>
	            <div class="rs_filter_group">
	              <div class="rs_filter_dec"><i class="fa fa-minus" aria-hidden="true"></i></div>
	              <div class="rs_filter"  data-value="50" data-key="quality_level"></div>
	              <div class="rs_filter_inc"><i class="fa fa-plus" aria-hidden="true"></i></div>
	            </div>
	          </div>
	        </div>
	        <div class="col-xs-12 col-sm-4">
	          <div class="rs_price_filter">
	            <h2 class="filter_title">Trust</h2>
	            <div class="rs_filter_group">
	              <div class="rs_filter_dec"><i class="fa fa-minus" aria-hidden="true"></i></div>
	              <div class="rs_filter"  data-value="100" data-key="trust_level"></div>
	              <div class="rs_filter_inc"><i class="fa fa-plus" aria-hidden="true"></i></div>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	  <div class="container">
	    <div class="range_bottom">
	      <div class="pull-right">
	        <p><i class="fa fa-comments" aria-hidden="true"></i> Based on <?= $model->num_rating ?> customer reviews</p>
	      </div>
	      <div class="pull-left">
	        <p><i class="fa fa-question-circle" aria-hidden="true"></i> Wondering how we rank the products?</p>
	      </div>
	      <div class="clear_fix"></div>
	    </div>
	  </div>
	</div>
	</div>

	<div class="product_list_section">
	<div class="container">
	  <div class="product_list" data-action="<?=Url::toRoute(['/top10/generate','id'=>$model->id]) ?>">
	  	<?= $this->render('_productList', [
			'products' => $model->top10Products,
		]) ?>
	  </div>
	</div>
</div>
      
<div class="default_article_section product_list_10_bottom">
<div class="container-fluid">
  <div class="title_group text-center">
    <h2>Wondering how we ranked the products?</h2>
    <h3>All ranking results are from real customers like you. Real people - real results!</h3>
  </div>
  <div class="default_contents">

  	<?= Yii::$app->imageCache->img('@mainUpload/' . $model->image_url, '600x600', ['class' => 'left_align_50']); ?>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
    <p><strong>Quality</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Price Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Trust Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p><strong>Trust</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <div class="clear_fix clearfix"></div>
  </div>
</div>
</div>

<div class="text-center more_10_items_list_section">
	<div class="container-fluid">

		<div class="search_box">
	      <h2>search for more products</h2>
	      <div class="search_form">
	        <form action="index.html">
	          <div class="input_s">
	            <input type="text" placeholder="What are you looking for?" class="form-control">
	          </div>
	          <div class="submit_s">
	            <button type="submit"><i class="fa fa-search"></i></button>
	          </div>
	          <div class="clear_fix"></div>
	        </form>
	        <div class="clear_fix"></div>
	      </div>
	    </div>

		<?=RecentTop10::widget()?>
	</div>
</div>