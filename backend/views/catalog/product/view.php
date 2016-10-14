<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\markdown\Markdown;
use kartik\markdown\MarkdownEditor;
use kartik\widgets\FileInput;
use kartik\grid\GridView;
use yii\widgets\Pjax;


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
        'attribute'=>'featured', 
        'label'=>'Featured?',
        'format'=>'raw',
        'value'=>$model->featured ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
        'type'=>DetailView::INPUT_SWITCH,
        'widgetOptions' => [
            'pluginOptions' => [
                'onText' => 'Yes',
                'offText' => 'No',
            ]
        ],
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
        'attribute'=>'sku', 
        'value'=>$model->sku
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
        'label'=>'Raking Info',
        'rowOptions'=>['class'=>'info'],
    ],
    [
        'attribute'=>'score', 
        'value'=>$model->score
    ],
    [
        'attribute'=>'price_level', 
        'value'=>$model->price_level
    ],
    [
        'attribute'=>'quality_level', 
        'value'=>$model->quality_level
    ],
    [
        'attribute'=>'trust_level', 
        'value'=>$model->trust_level
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
    ],
    [
        'attribute'=>'meta_keywords', 
        'value'=>$model->meta_keywords
    ],
    [
        'attribute'=>'meta_description', 
        'value'=>$model->meta_description
    ]

];

$allImages = [];
$allImageConfig = [];

foreach($model->productImages as $pImage) {
    $allImages[] = Yii::$app->imageCache->img('@mainUpload/' . $pImage->image_url, '300x200', ['class' => 'file-preview-image']);
    $allImageConfig[] =[   
            'caption' => 'Image',
            'url' => Url::toRoute(['detach', 'id'=>$model->id, 'imageId' => $pImage->id])
    ];    
}


//Product additional information
//
$viewMsg = 'Not applicable';
$updateMsg = 'Not applicable';
$deleteMsg = 'Delete Product information';

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'store_id',
        'pageSummary' => 'Page Total',
        'vAlign'=>'middle',
        'value'=>function ($model, $key, $index, $widget) { 
            return $model->store->title;
        }
    ],
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'product_url',
        'vAlign'=>'middle',
        'headerOptions'=>['class'=>'kv-sticky-column'],
        'contentOptions'=>['class'=>'kv-sticky-column'],
        'editableOptions'=>['header'=>'Title']
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
            if ($action == 'delete') {
                return Url::toRoute(['deleteinfo', 'id'=>$model->product->id, 'infoId'=>$key]);
            } else {
                return '';
            }
        },
        'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip', 'style'=>'display:none;'],
        'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip', 'style'=>'display:none;'],
        'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'], 
    ],
];

$this->registerJs(
   '$(document).ready(function(){ 
        $(document).on("click", "#reset_productinfos", function() {
            $.pjax.reload({container:"#productinfos"});  //Reload GridView
        });
    });'
);

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

<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border" id>
    <h3 class="box-title">Additional Product Informations</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'toolbar'=> false,
        'export' => false,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'showFooter' => false,
        'hover' => true,
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => false,
        ],
        'toolbar'=> [
            ['content'=>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add', 'id'=>'add_productinfos', 'class'=>'showModalButton btn btn-success', 'value'=>Url::toRoute(['addinfo', 'id'=>$model->id])]) . ' ' .
                Html::button('<i class="glyphicon glyphicon-repeat"></i>', ['type'=>'button', 'title'=>'Add', 'id'=>'reset_productinfos', 'class'=>'btn btn-default'])
            ],
        ],
        'pjaxSettings' => [
            'neverTimeout' => true,
            'options' => [
                'id' => 'productinfos'
            ]
        ]
    ]);?>

    </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
    <div class="box-header with-border">
        <h3 class="box-title">Product Images</h3>

        <?= FileInput::widget([
            'name'=>'temp_images[]',
            'options' => [
                'multiple' => true,
                'id' => 'input-888'
            ],
            'pluginOptions' => [
                'uploadAsync' =>  false,
                'maxFileCount' =>  10,
                'initialPreview' => $allImages,
                'initialPreviewConfig' => $allImageConfig,
                'initialPreviewAsData' => false,
                'overwriteInitial' => false,
                'showClose' => false,
                'showBrowse' => true,
                'showRemove' => false,
                'showUpload' => false,
                'previewFileType' => 'image',
                'uploadUrl' => Url::toRoute(['upload', 'id'=>$model->id]),
            ]
        ]) ?>
    </div>
    </div>
<div>
?>

<?php
    yii\bootstrap\Modal::begin([
        'header' => 'Add Product Info',
        'id'=>'addProductInfoModal',
        'class' =>'modal',
        'size' => 'modal-md',
    ]);
        echo "<div class='modalContent' id='modalContent'></div>";
    yii\bootstrap\Modal::end();
        //js code:
    $this->registerJs('

        $(document).ready(function(){ 
            $(document).on("click", "#add_productinfos", function() {
                $("#addProductInfoModal").modal("show")
                    .find("#modalContent")
                    .load($(this).attr("value"));
            });
        });
    ');
?>
