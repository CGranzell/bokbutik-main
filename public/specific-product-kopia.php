<?php
require('../src/config.php');
include(LAYOUT_PATH . 'header-public.php');
// Hämtar en product
$product = $userDbHandler->fetchOneProduct($_GET['productID']);


?>

 
      

      <div class="card card-specific mx-auto" style="width: 58rem;">
			<img src="admin/<?=htmlentities($product['img_url']) ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Title: <?= htmlentities($product['title']) ?></h5>
    <p class="card-text">Price: <?= htmlentities($product['price']) ?></p>
    <p class="card-text">Stock: <?= htmlentities($product['stock']) ?></p>
    <p class="card-text">Description: <?= htmlentities($product['description']) ?></p>
    
    <form action="add-cart-item.php" method="POST">
        <input type="submit" name="addToCart"value="Add to cart" class="btn btn-primary">
        <input type="number" name="quantity" value="1" min="0">
        <input type="hidden" name="productID" value="<?= htmlentities($product['id']) ?>">
      </form>
  </div>
</div>



<?php 
include(LAYOUT_PATH . 'footer.php');
?>

