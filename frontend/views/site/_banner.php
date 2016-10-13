<?php
use frontend\widgets\SearchBox;
?>

<div class="banner_section">
  <div class="container">
    <div class="search_box">
      <h2>
        compare the best,<br/>buy the cheapest for you
      </h2>
      <div class="search_form">
        <?= SearchBox::widget(['type'=>'banner']) ?>
        <div class="clear_fix"></div>
      </div>
    </div>
  </div>
</div>