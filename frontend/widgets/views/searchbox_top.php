<?php

use yii\helpers\Url;

?>
<form action="<?=Url::toRoute($actionUrl)?>" method="post" class="tw_search">
  <input type="text" name="<?= $name ?>" placeholder="Search..">
  <button type="submit" name='ts'><i class="fa fa-search"></i></button>
</form>