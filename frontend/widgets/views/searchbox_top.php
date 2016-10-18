<?php

use yii\helpers\Url;

?>
<form action="<?=Url::toRoute($actionUrl)?>" method="post" class="tw_search" id="tw_search_top">
  <input type="text" name="<?= $name ?>" autocomplete="off" placeholder="Search..">
  <button type="submit" name='ts'><i class="fa fa-search"></i></button>
</form>