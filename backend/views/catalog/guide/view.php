<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\markdown\Markdown;
use kartik\markdown\MarkdownEditor;
use kartik\widgets\FileInput;


/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Guides', 'url' => ['index']];
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
        'attribute'=>'description', 
        'format'=>'raw',
        'value'=>Markdown::convert($model->description),
        'type'=>DetailView::INPUT_WIDGET,
        'widgetOptions'=>[
            'class' => MarkdownEditor::classname()
        ]
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


//images
$allImages = [];
$allImageConfig = [];

if ($model->image_url) {
    $allImages[] = Yii::$app->imageCache->img('@mainUpload/' . $model->image_url, '200x150', ['class' => 'file-preview-image']);
    $allImageConfig[] =[   
            'caption' => 'Current Image',
            'url' => Url::toRoute(['detach', 'id'=>$model->id])
    ];    
}

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
    <div class="box-header with-border">
        <h3 class="box-title">Guide Image</h3>

        <?= FileInput::widget([
            'name'=>'new_guide_image',
            'options' => [
                'id' => 'input-888'
            ],
            'pluginOptions' => [
                'uploadAsync' =>  false,
                'maxFileCount' =>  1,
                'initialPreview' => $allImages,
                'initialPreviewConfig' => $allImageConfig,
                'initialPreviewAsData' => false,
                'overwriteInitial' => true,
                'autoReplace' => true,
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