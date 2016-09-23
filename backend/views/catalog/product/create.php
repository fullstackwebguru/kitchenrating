<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12">
    <div class="box">
    <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

    </div>
    </div>
    </div>

</div>
