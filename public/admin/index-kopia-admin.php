<?php
require('../../src/config.php');
include(LAYOUT_PATH_ADMIN . 'header.php');

$imgUrl= "";
$error = "";
$messages = "";

if (isset($_POST['uploadBtn'])) 


  if (is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) {
    $fileName = $_FILES['uploadedFile']['name'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileTempPath = $_FILES['uploadedFile']['tmp_name'];
   
    $path = '../../../img/';
    // $path ="img/";
    $newFilePath = $path . $fileName;

    $allowedFileTypes = [
      'image/png',
      'image/jpeg',
      'image/gif',
      'image/jpg',
    ];
    $isFileTypeAllowed = array_search($fileType, $allowedFileTypes, true);
    
    if ($isFileTypeAllowed === false) {
      $error = "The file type is invalid. Allowed types are jpeg, png, gif. <br>";
    }

    if ($_FILES < 1000000) {
      $error .= 'Exceeded filesize limit.<br>';
    }

    $img_size = getimagesize($fileTempPath);

    if (empty($error)) {


    $isTheFileUploaded = move_uploaded_file($fileTempPath, $newFilePath);

    if ($isTheFileUploaded) {
        $imgUrl = $newFilePath;
        $messages = "Upload success";
    } else {
      $error = "Could not upload the file";
    }

  } else {
  $messages = $error;
}
if (empty($error)) {

    // skapar och fyller array med product info
    $productInfo = [
      //Tar bort mellanslag före och efter textsträng
      $title       = trim($_POST['title']),
      $description = trim($_POST['description']),
      $price       = trim($_POST['price']),
      $stock       = trim($_POST['stock']),
      $img_url     = trim($imgUrl),
    ];
    // Lägger till produkt
    $userDbHandler->addProduct($productInfo);
    
}
}

if (isset($_POST['deleteProductBtn'])) {
  // Tar bort en produkt
  $userDbHandler->deleteProduct();
}

// Hämtar alla produkter
$products = $userDbHandler->fetchAllProducts();
?>



<h1>Admin</h1>


   <table id="products-tbl">
	   <thead>
		   <tr>
			   <th>Title</th>
			   <th>Description</th>
			   <th>Price</th>
			   <th>Stock</th>
         <th>Img_url</th>


		   </tr>
	   </thead>

	   <tbody>
		   <?php

          foreach ($products as $product) { ?>
          <tr>

              <td><?=htmlentities($product['title']) ?></td>
              <td><?=htmlentities($product['description']) ?></td>
              <td><?=htmlentities($product['price']) ?></td>
              <td><?=htmlentities($product['stock']) ?></td>
              <td><?=htmlentities($product['img_url']) ?></td>
                  

              <td>
              <form action="" method="POST">
                      <input type="hidden" name="productId" value="<?=$product['id'] ?>">
                      <input type="submit" name="deleteProductBtn" value="Delete"><br></form>



            <form action="update-product.php" method="GET">
                <input type="submit" value="Update">
                <input type="hidden" name="productId" value="<?= htmlentities($product['id']) ?>">
            </form>
          </td>
        </tr>
        <?php }?>
  </tbody>
</table>

   <form action="" method="POST" enctype="multipart/form-data">
	   <input type="text" name="title" placeholder="Title"><br>
	   <input type="text" name="description" placeholder="Description"><br>
	   <input type="text" name="price" placeholder="Price"><br>
	   <input type="text" name="stock" placeholder="Stock"><br>
     <input type="file" name="uploadedFile"><br>

		<input type="submit" value="Add Product" name="uploadBtn">
   </form>

   <?=$messages?>

		<?php 
include(LAYOUT_PATH_ADMIN . 'footer.php');
?>
