<?php
require('../src/config.php');
include(LAYOUT_PATH . 'header-public.php');
// Hämtar en product
$product = $userDbHandler->fetchOneProduct($_GET['productID']);


?>

 
      

      <div class="card card-specific mx-auto" style="width: 58rem;">
			<img src="<?=htmlentities($product['img_url']) ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?= htmlentities($product['title']) ?></h5>
    <p class="card-text"><?= htmlentities($product['price']) ?></p>
    <p class="card-text"><?= htmlentities($product['stock']) ?></p>
    <p class="card-text"><?= htmlentities($product['description']) ?></p>
    <a href="#" class="btn btn-primary">Add to Cart</a>
  </div>
</div>



<?php 
include(LAYOUT_PATH . 'footer.php');
?>

