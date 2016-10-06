<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<nav class="navbar navbar-default navbar-static-top header_section">
    <div class="container">
      <div class="navbar-header">
        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button><!-- 
        <div class="pull-right">
          <div class="header_search_box">
            <form action="index.html">
              <input placeholder="Search.." type="text" name="stop">
              <button type="submit" name='ts'><i class="fa fa-search"></i></button>
            </form>
          </div>
        </div> -->
        <a href="<?=Url::toRoute(['/'])?>" class="navbar-brand top_logo">
          KitchenRatings
        </a>
      </div>
      <div class="navbar-collapse collapse" id="navbar">
        <ul class="nav navbar-nav navbar-right rs_main_menu">
          <li>
            <?=  Html::a('Home',['/']) ?>
          </li>
          <li>
            <?=  Html::a('About',['/site/about']) ?>
          </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
</nav>