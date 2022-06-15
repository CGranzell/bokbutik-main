<?php
require('../../src/config.php');
include(LAYOUT_PATH_ADMIN . 'header-admin.php');


$imgUrl= "";
$error = "";
$messages = "";

if (isset($_POST['uploadBtn'])) 


  if (is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) {
    $fileName = $_FILES['uploadedFile']['name'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileTempPath = $_FILES['uploadedFile']['tmp_name'];
   
    $path = 'img/';
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

<div class="mt-5 container">
  <br />
  <br />
  <table class="table border p-2">
    <thead>
      <tr>             
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Price</th>
        <th scope="col">Stock</th>
        <th scope="col">Img url</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) { ?>
        <tr>
          <td scope="row"><?=htmlentities($product['title']) ?></td>
          <td><?=htmlentities($product['description']) ?></td>
          <td><?=htmlentities($product['price']) ?></td>
          <td><?=htmlentities($product['stock']) ?></td>
          <td><?=htmlentities($product['img_url']) ?></td>
          <td> 
            <form action="" method="POST">
              <input type="hidden" name="productId" value="<?=$product['id'] ?>">
              <input type="submit" name="deleteProductBtn" value="Delete" class="btn btn-primary"><br>
            </form>
            <form action="update-product-kopia.php" method="GET">
                <input type="submit" value="Update" class="btn btn-primary">
                <input type="hidden" name="productId" value="<?= htmlentities($product['id']) ?>">
            </form>      
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  
  <form method="POST" action="" enctype="multipart/form-data" class="form mx-auto">
		  <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
		  <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" rows="3" name="description"></textarea>
      </div>
		  <div class="mb-3">
        <label for="price" class="form-label">price</label>
        <input type="text" class="form-control" id="price" name="price">
      </div>
		  <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="text" class="form-control" id="stock" name="stock">
      </div>
		  <div class="mb-3" id="inputBtn">
        <input type="file" name="uploadedFile" ><br>
        <input type="submit" value="Add Product" name="uploadBtn" class="btn btn-primary">
    </form>
  </div>
</div>


   <?=$messages?>

		<?php 
include(LAYOUT_PATH_ADMIN . 'footer.php');
?>
