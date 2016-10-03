<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;

$viewMsg = 'View Category Details';
$updateMsg = 'Update Category Details';
$deleteMsg = 'Delte Category';

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'title',
        'pageSummary' => 'Page Total',
        'vAlign'=>'middle',
        'headerOptions'=>['class'=>'kv-sticky-column'],
        'contentOptions'=>['class'=>'kv-sticky-column'],
        'editableOptions'=>['header'=>'Title']
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'attribute'=>'status', 
        'vAlign'=>'middle'
    ], 
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { return Url::toRoute([$action, 'id'=>$key]); },
        'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
        'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'], 
    ],
];

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
    <!-- <div class="box">
    <div class="box-body"> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'toolbar' => false,
        'export' => false,
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]);?>
    <!-- </div>
    </div> -->
    </div>
</div>
