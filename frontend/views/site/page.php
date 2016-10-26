<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\markdown\Markdown;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag([
            'name'=>'keywords',
            'content' => $model->meta_keywords
        ]);

$this->registerMetaTag([
            'name'=>'description',
            'content' => $model->meta_description
        ]);
        
?>

<div class="all_guides_arcive">
    <div class="container">
      <div class="bread_crumb">
        <ul>
          <li><?=  Html::a('Home',['/']) ?></li>
          <li><span>/</span></li>
          <li><strong><?= $model->title ?></strong></li>
        </ul>
      </div>
      <div class="all_guides_list">
        <div class="row">
          <div class="container">
            <?= Markdown::convert($model->description) ?>
          </div>   
        </div>
      </div>
    </div>
  </div>