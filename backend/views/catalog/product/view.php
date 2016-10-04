<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\markdown\Markdown;
use kartik\markdown\MarkdownEditor;


/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$attributes = [
    [
        'group'=>true,
        'label'=>'Basic Details',
        'rowOptions'=>['class'=>'info'],
    ],
    [
        'attribute'=>'id', 
        'label'=>'Product #',
        'displayOnly'=>true,
    ],
    [
        'attribute'=>'title', 
        'value'=>$model->title
    ],
    [
        'attribute'=>'category_id',
        'format'=>'raw',
        'value'=>Html::a($model->category->title,  
                ['catalog/category/view', 'id'=>$model->category_id], 
                ['title'=>'View category detail']),
        'type'=>DetailView::INPUT_SELECT2, 
        'widgetOptions'=>[
            'data'=>ArrayHelper::map($categories, 'id', 'title'), 
            'options' => ['placeholder' => 'Select ...'],
            'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
        ]
    ],
    [
        'attribute'=>'status', 
        'label'=>'Available?',
        'format'=>'raw',
        'value'=>$model->status ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
        'type'=>DetailView::INPUT_SWITCH,
        'widgetOptions' => [
            'pluginOptions' => [
                'onText' => 'Yes',
                'offText' => 'No',
            ]
        ],
    ],
    [
        'group'=>true,
        'label'=>'Product Info',
        'rowOptions'=>['class'=>'info'],
    ],
    [
        'attribute'=>'store_id',
        'format'=>'raw',
        'value'=>$model->store->title, 
        'type'=>DetailView::INPUT_SELECT2, 
        'widgetOptions'=>[
            'data'=>ArrayHelper::map($stores, 'id', 'title'), 
            'options' => ['placeholder' => 'Select ...'],
            'pluginOptions' => ['allowClear'=>true, 'width'=>'100%'],
        ]
    ],
    [
        'attribute'=>'description', 
        'format'=>'raw',
        'value'=>Markdown::convert($model->description),
        'type'=>DetailView::INPUT_WIDGET,
        'widgetOptions'=>[
            'class' => MarkdownEditor::classname()
        ]
    ],
    [
        'attribute'=>'product_url', 
        'value'=>$model->product_url
    ],
    [
        'attribute'=>'rating', 
        'value'=>$model->rating
    ],
    [
        'attribute'=>'num_rating', 
        'value'=>$model->num_rating
    ],
    [
        'group'=>true,
        'label'=>'SEO Information',
        'rowOptions'=>['class'=>'info']
    ],
    [
        'attribute'=>'color', 
        'format'=>'raw', 
        'value'=>"<span class='badge' style='background-color: {$model->color}'> </span>  <code>" . $model->color . '</code>',
        'type'=>DetailView::INPUT_COLOR
    ],
    [
        'attribute'=>'slug', 
        'value'=>$model->slug
    ]
];


?>

<div class="row">
    <div class="col-xs-12">

    <?= DetailView::widget([
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>$viewMode,
        'deleteOptions'=>[ // your ajax delete parameters
            'params' => ['id' => $model->id, 'kvdelete'=>true],
        ],
        'panel'=>[
            'heading'=>'Product Details',
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => $attributes,
        'formOptions' => ['action' => Url::toRoute(['view', 'id'=>$model->id])]
    ]);?>

    </div>

</div>