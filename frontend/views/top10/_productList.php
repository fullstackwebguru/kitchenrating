<?php 
		foreach($products as $i => $product) {
?>
		<?= $this->render('_product', [
        'product' => $product,
        'rank' => $i+1
   		]) ?>
<?php
	}	
?>