<?php
require('../src/config.php');
include(LAYOUT_PATH . 'header-public.php');

//CONNECT TO READ-MORE BUTTON
if (isset($_POST['Readmore'])) {
 $userDbHandler->fetchOneProduct($_POST['id']);
} 
//READ 
$products = $userDbHandler->fetchAllProducts();



?>


	<h1 class="fredriks-huvudrubrik">Welcome to the Bok Store</h1>
	<h3 class="fredriks-huvudrubrik">Our selection</h3>
   <!-- Container rows -->
   <?php foreach ($products as $product) : ?>
    <div class="container-index">
		
      <div class="card  card-index" style="width: 18rem;">
        <img src="admin/<?=htmlentities($product['img_url']) ?>" class="card-img-top" alt="...">
       
      <div class="card-body">
        <h5 class="card-title"><?=htmlentities($product['title']) ?></h5>
        <p class="card-text">Price: <?=htmlentities($product['price']) ?> $</p>
        <p class="card-text">In stock: <i><?=htmlentities($product['stock']) ?></i></p>
        <div class="description-wrapper">
          <p class="card-text">About the book: <br> "<?= substr( htmlentities($product['description']), 0, 100) ?>"</p>
          
        </div>

        
          <form action="add-cart-item-chris.php" method="POST">
            <input type="submit" name="addToCart"value="Add to cart" class="btn btn-primary">
            <input type="number" name="quantity" value="1" min="0">
            <input type="hidden" name="productID" value="<?= htmlentities($product['id']) ?>">
          </form>
				<form action="specific-product-kopia.php" method="GET">
        <input type="submit" value="Read more" class="btn btn-primary read-more-btn">
        <input type="hidden" name="productID" value="<?= htmlentities($product['id']) ?>">
      </form>
      

    </div>
  </div>
</div>

<?php endforeach ?>


   
		<?php 
include(LAYOUT_PATH . 'footer.php');
?>
