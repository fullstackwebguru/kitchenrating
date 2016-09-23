<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-3 col-xs-6">
		<div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total</span>
              <span class="info-box-number">90</span>
            </div>
            <!-- /.info-box-content -->
        </div>
	</div>

	<div class="col-sm-3 col-xs-6">
		<div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Disabled</span>
              <span class="info-box-number">4</small></span>
            </div>
            <!-- /.info-box-content -->
        </div>
	</div>

	<div class="col-sm-6 col-xs-12">

		<div class="row">
		    <div class="col-sm-6 col-xs-12">
		      
		    </div>
		    <!-- /.col -->
		    <div class="col-sm-6 col-xs-12">
    		    <a href="<?= Url::to(['create'])?>" class="pull-right">
    		    	<div class="description-block border-right">
    		    		<span class="icon-button"><i class="ion ion-plus-circled"></i></span>
    			        <h5 class="description-text">New Category</h5>
    			    </div>
                 </a>
		      <!-- /.description-block -->
		    </div>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-xs-12">
    <div class="box">
    <div class="box-body">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'parent_id',
                'value' => function($model) {
                    return empty($model->parent_id) ? '' : $model->parent->title;
                }
            ],

            'title',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    switch ($model->status) {
                        case Category::STATUS_DELETED:
                            return "deleted";
                        default:
                            return "Active";
                    }
                }
            ],
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    </div>
    </div>
</div>
