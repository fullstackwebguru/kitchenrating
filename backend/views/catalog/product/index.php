<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
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
                        <h5 class="description-text">New Product</h5>
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
        <?php Pjax::begin(); ?>    <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'category_id',
                    'title',
                    'description:ntext',
                    // 'rating',
                    // 'num_rating',
                    // 'status',
                    // 'created_at',
                    // 'updated_at',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
    </div>
    </div>
</div>
