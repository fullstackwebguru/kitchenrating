<?php

use yii\helpers\Url;

?>
<form action="<?=Url::toRoute($actionUrl)?>" method="post" class="tw_search">

<div class="sidebar_search">
  <input type="text" name="<?= $name ?>" placeholder="searching for...">
  <button type="submit"><i class="fa fa-search"></i>Search</button>
</div>

</form>