<?php

use yii\helpers\Url;

?>
<form action="<?=Url::toRoute($actionUrl)?>" method="post" class="tw_search">

<div class="sidebar_search">
  <input type="text" name="<?= $name ?>" autocomplete="off" placeholder="searching for...">
  <button type="button"><i class="fa fa-search"></i>Search</button>
</div>

<div id="tw_search_result_side">
</div>
</form>