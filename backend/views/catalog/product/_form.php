<?php

use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\markdown\MarkdownEditor;
use kartik\widgets\FileInput;


$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL,'options' => ['enctype'=>'multipart/form-data']]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'category_id'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\Select2', 
            'options'=>['data'=>ArrayHelper::map($categories, 'id', 'title')]
        ],
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'title'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter title...']]
    ]
]);

echo $form->field($model, 'description')->widget(
    MarkdownEditor::classname(), 
    ['height' => 300, 'encodeLabels' => false]
);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'product_url'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter product url...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'sku'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter sku...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'store_id'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\Select2', 
            'options'=>['data'=>ArrayHelper::map($stores, 'id', 'title')],
        ],
    ]
]);


echo Form::widget([       // 3 column layout
    'model'=>$model,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>[
        'rating'=>[
            'type'=>Form::INPUT_TEXT, 
            'options'=>['placeholder'=>'Enter product rating...']
        ],
        'num_rating'=>[
            'type'=>Form::INPUT_TEXT
        ]
    ]
]);



echo Form::widget([       // 3 column layout
    'model'=>$model,
    'form'=>$form,
    'columns'=>4,
    'attributes'=>[
        'price_level'=>[
            'type'=>Form::INPUT_TEXT, 
            'options'=>['placeholder'=>'Enter price level...']
        ],
        'quality_level'=>[
            'type'=>Form::INPUT_TEXT, 
            'options'=>['placeholder'=>'Enter quality level...']
        ],
        'trust_level'=>[
            'type'=>Form::INPUT_TEXT, 
            'options'=>['placeholder'=>'Enter trust level...']
        ],
        'score'=>[
            'type'=>Form::INPUT_TEXT, 
            'options'=>['placeholder'=>'Enter score...']
        ],
    ]
]);


echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'meta_description'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter description for SEO...']]
    ]
]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'meta_keywords'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter keywords for SEO...']]
    ]
]);
   
echo Form::widget([       // 3 column layout
    'model'=>$model,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>[
        'color'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\ColorInput', 
            'hint'=>'Choose your color'
        ],
        'status'=>[
            'type'=>Form::INPUT_RADIO_LIST, 
            'items'=>[true=>'Active', false=>'Inactive'], 
            'options'=>['inline'=>true]
        ],
        'actions'=>[
            'type'=>Form::INPUT_RAW, 
            'value'=>'<div style="text-align: right; margin-top: 20px">' . 
                Html::resetButton('Reset', ['class'=>'btn btn-default']) . ' ' .
                Html::button('Submit', ['type'=>'submit', 'class'=>'btn btn-primary']) . 
                '</div>'
        ],
    ]
]);

ActiveForm::end();
?>