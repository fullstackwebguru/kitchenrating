<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

 <div class="footer">
    <div class="container">
        <div class="pull-right">
            <ul class="nav nav-pills">
                <li><?=  Html::a('Home',['/site']) ?></li>
                <li><?=  Html::a('Privacy',['/site/policy']) ?></li>
                <li><?=  Html::a('ToS',['/site/tos']) ?></li>
                <li><?=  Html::a('Disclamer',['/site/disclaimer']) ?></li>
                <li><?=  Html::a('Contact',['/site/contact']) ?></li>
            </ul>
        </div>
        <div class="pull-left">
            <p class="copy_right">&copy; Copyright 2016 KitchenRatings. All rights reserved.</p>
        </div>
    </div>
</div>
