<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Featured Products';
$this->params['breadcrumbs'][] = $this->title;

$viewMsg = 'View Product Details';
$updateMsg = 'Update Product Details';
$deleteMsg = 'Remove Product from Featured';

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'vAlign'=>'middle',
        'width'=>'80px',
        'format' => 'raw',
        'value'=>function ($model, $key, $index, $widget) { 

            $pms = $model->productImages;
            if ($pms & count($pms) > 0) {
                return Yii::$app->imageCache->img('@mainUpload/' . $pms[0]->image_url, '80x80', ['class' => 'file-preview-image']);
            } else {
                return "";
            }
        },
    ],
    [
        'attribute' => 'title',
        'vAlign'=>'middle',
    ],
    [
        'attribute'=>'category_id', 
        'vAlign'=>'middle',
        'width'=>'180px',
        'value'=>function ($model, $key, $index, $widget) { 
            return Html::a($model->category->title,  
                ['catalog/category/view', 'id'=>$model->category_id], 
                ['title'=>'View category detail']);
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map($categories, 'id', 'title'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Any category'],
        'format'=>'raw'
    ],
    [
        'attribute'=>'store_id', 
        'vAlign'=>'middle',
        'width'=>'180px',
        'value'=>function ($model, $key, $index, $widget) { 
            return $model->store->title;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map($stores, 'id', 'title'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Any store'],
        'format'=>'raw'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
            if ($action == 'update') {
                return Url::toRoute(['view', 'id'=>$key, 'viewMode'=>'edit']);     
            } else {
                return Url::toRoute([$action, 'id'=>$key]);
            }
        },
        'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip', 'style'=>'display:none;'],
        'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip', 'style'=>'display:none;'],
        'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'], 
    ],
];

?>

<div class="row">
    <div class="col-xs-12">
    <!-- <div class="box">
    <div class="box-body"> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'toolbar'=> false,
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