<?php

use yii\helpers\Url;

?>
<form action="<?=Url::toRoute($actionUrl)?>" method="post" class="tw_search" id="tw_search_product">
  <div class="input_s">
    <input type="text" name="<?= $name ?>" autocomplete="off" placeholder="What are you looking for?">
    <div id="tw_search_result_product">
  	</div>
  </div>
  <div class="submit_s">
    <button type="button"><i class="fa fa-search"></i></button>
  </div>
  <div class="clear_fix"></div>
</form>