<?php

use yii\helpers\Url;
?>

<div class="single_sidebar news_letter">
    <h2>Newsletter</h2>
    <form action="<?=Url::toRoute($actionUrl)?>" method="post">
      <input type="email" name="<?= $name ?>" required class="form-control" placeholder="type your email address">
      <button class="btn btn-default btn_common">SIGN UP NOW</button>
    </form>
</div>