<?php

use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\Html;


$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'category_id'=>[
            'type'=>Form::INPUT_WIDGET, 
            'widgetClass'=>'\kartik\widgets\Select2', 
            'options'=>['data'=>ArrayHelper::map($categories, 'id', 'title')], 
            'hint'=>'Type and select category'
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

echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=> 1,
    'attributes'=>[       //  column layout
        'description'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter title...']]
    ]
]);

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
        'product_store'=>[
            'type'=>Form::INPUT_RADIO_LIST, 
            'items'=>['Amazon'=>'Amazon', 'Ebay'=>'Ebay'],
            'options'=>['inline'=>true]
        ],
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

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($categories, 'id', 'title'), ['prompt' => 'Select category ...']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <?= $form->field($model, 'num_rating')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
