<?php
require('../src/config.php');
include(LAYOUT_PATH . 'header-public.php');

 //READ PRODUCT

 $product = $userDbHandler->fetchOneProduct($_GET['productID']);
  
?>

<div class="card card-specific mx-auto" style="width: 58rem;">
      
			<img src="<?=htmlentities($product['img_url']) ?>" class="card-img-top2"  alt="...">
    
  <div class="card-body">
    <h5 class="card-title">Title: <?= htmlentities($product['title']) ?></h5>
    <p class="card-text">Price: <?= htmlentities($product['price']) ?></p>
    <p class="card-text">Stock: <?= htmlentities($product['stock']) ?></p>
    <p class="card-text">Description: <?= htmlentities($product['description']) ?></p>
    <a href="#" class="btn btn-primary">Add to Cart</a>
  </div>
</div>



<?php 
include(LAYOUT_PATH . 'footer.php');
?>
