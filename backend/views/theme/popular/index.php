<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Popular Categories';
$this->params['breadcrumbs'][] = $this->title;

$viewMsg = 'View Category Details';
$updateMsg = 'Update Category Details';
$deleteMsg = 'Remove Category from Popular List';

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'title',
        'vAlign'=>'middle',
        'value'=>function ($model, $key, $index, $widget) { 
            return Html::a($model->title,  
                ['catalog/category/view', 'id'=>$model->id], 
                ['title'=>'View category detail']);
        },
        'format'=>'raw'
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
