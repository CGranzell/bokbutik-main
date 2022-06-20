<?php
require('../src/config.php');
include(LAYOUT_PATH . 'header-public.php');
?>

<?php

	/*$imgUrl   = "";
	$error    = "";
	$messages = "";
	
if (isset($_POST['uploadBtn'])) {
	
	if (is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) { //Har filen laddats upp?
	
		
		$fileName 	    = $_FILES['uploadedFile']['name'];
		$fileType 	    = $_FILES['uploadedFile']['type'];
		$fileTempPath   = $_FILES['uploadedFile']['tmp_name'];
		$path 		    = "img/";
		// uploads/dummy-profile.png
	$newFilePath = $path . $fileName; //sökvägen och namnet
	}

	
	
	if ($_FILES['uploadedFile']['size'] > 2000000) {  // Allows only files under 2 mbyte, 2 miljon byte
			$error .= 'Exceeded filesize limit.<br>';  
		}
		
		if (empty($error)) {
			$isTheFileUploaded = move_uploaded_file($fileTempPath, $newFilePath);
	
			if ($isTheFileUploaded) {
				// Success the file is uploaded
				$imgUrl = $newFilePath;
			} else {
				// Could not upload the file...
				$error = "Could not upload the file";---
			}
		}
	
	} *///HÄR SLUTAR BILDHANTERINGEN
	$products = $userDbHandler->fetchAllProducts();
	?>

<h1 class="fredriks-huvudrubrik">Welcome to the Bok Store</h1>
	<h3 class="fredriks-huvudrubrik">Our selection</h3>
   <!-- Container rows -->
   <?php foreach ($products as $product) : ?>
    <div class="container-index">
	
      <div class="card  card-index" style="width: 18rem;">
      <img src="admin/<?=($product['img_url'])?>" class="card-img-top" alt="...">
       
      <div class="card-body">
        <h5 class="card-title"><?=htmlentities($product['title']) ?></h5>
        <p class="card-text">Price: <?=htmlentities($product['price']) ?> $</p>
        <p class="card-text">In stock: <i><?=htmlentities($product['stock']) ?></i></p>
        <div class="description-wrapper">
        <p class="card-text">About the book: <br> "<?= substr( htmlentities($product['description']), 0, 100) ?>"</p>

        </div>

		<form action="specific-product.php" method="GET">
        <input type="submit" value="Read more" class="btn btn-primary">
        <input type="hidden" name="productID" value="<?= htmlentities($product['id']) ?>">
      </form>
    </div>
  </div>
</div>
<?php endforeach ?>


   
		<?php 
include(LAYOUT_PATH . 'footer.php');
?>


	


