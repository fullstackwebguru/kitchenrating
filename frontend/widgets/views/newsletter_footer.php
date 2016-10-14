<?php

use yii\helpers\Url;
?>

<div class="signup_box">
	<label>Get latest deals in inbox</label>
	
	<div class="input_box">
	<form action="<?=Url::toRoute($actionUrl)?>" method="post">
	  <input type="email" name="<?= $name ?>" required placeholder="SUBSCRIBE NEWSLETTER" class="form-control">
	  <button class="signup_btn">SIGNUP</button>
	</form>
	</div>
</div>