<?php
require('../../src/config.php');
include(LAYOUT_PATH_ADMIN . 'header-admin.php');

if(isset($_POST['updateAccountBtn'])) {


    // skapar och fyller array med product info
    $productInfo = [
      //Tar bort mellanslag före och efter textsträng
      $title       = trim($_POST['title']),
      $description = trim($_POST['description']),
      $price       = trim($_POST['price']),
      $stock       = trim($_POST['stock']),
      $img_url     = trim($_POST['img_url']), 
    ];

    $productId = $userDbHandler->fetchOneProduct($_GET['productId']);

    $update = $userDbHandler->updateProduct($_GET['productId'], $productInfo);


  redirect("index", "updateSucces");

  
}


$product = $userDbHandler->fetchOneProduct($_GET['productId']);
?>


  <div class="wrapper-register">
    <h1>Uppdatera </h1>
  </div>


  <form method="POST" action="" enctype="multipart/form-data" class="form mx-auto">

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="<?= htmlentities($product['title']) ?> ">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <input type="description" class="form-control" id="description" name="description" value="<?= htmlentities($product['description']) ?>">
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">Price</label>
      <input type="text" class="form-control" id="price" name="price" value="<?= htmlentities($product['price']) ?>">
    </div>

    <div class="mb-3">
      <label for="stock" class="form-label">Stock</label>
      <input type="stock" class="form-control" name="stock" value="<?= htmlentities($product['stock']) ?>">
    </div>

    <div class="mb-3">
      <label for="img_url" class="form-label">Image</label><br>
      <input type="hidden" id="img_url" name="img_url"> <img src="<?=($product['img_url'])?>">
      <div class="mb-3" id="inputBtn">
        <input type="file" name="uploadedFile" ><br>
        <input type="submit" value="Add File" name="uploadBtn" class="btn btn-primary">
        
    </div>
    

    <!-- Update Btn -->
    <input type="submit" class="btn btn-primary btn-form" name="updateAccountBtn" value="Uppdatera">

  </form>

  <?php 
include(LAYOUT_PATH_ADMIN . 'footer.php');
?>
