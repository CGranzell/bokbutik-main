<?php
require('../../src/config.php');
include(LAYOUT_PATH_ADMIN . 'header-admin.php');


// $productId = $userDbHandler->fetchOneProduct($_GET['productId']);
// $productId = $_GET['productId'];
// Felmeddelande sätts till tomt
// Uppdatera användaruppgift
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

  // $sql = "
  //   UPDATE products
  //   SET
  //     title=:title,
  //     description=:description,
  //     price=:price,
  //     stock=:stock,
  //     img_url=:img_url
  //   WHERE id =:id
  //   ";
  // $statement = $dbconnect->prepare($sql);
  // $statement->bindParam(':id', $productId);
  // $statement->bindParam(':title', $_POST['title']);
  // $statement->bindParam(':price', $_POST['price']);
  // $statement->bindParam(':description', $_POST['description']);
  // $statement->bindParam(':stock', $_POST['stock']);
  // $statement->bindParam(':img_url', $_POST['img_url']);
  // $statement->execute();


  redirect("index-kopia-admin", "updateSucces");

  // if ($sql) header('Location: http://localhost/bokbutik-main/public/admin/index.php') ;
}
 // Hämtar en användaruppgift

$product = $userDbHandler->fetchOneProduct($_GET['productId']);
?>


  <div class="wrapper-register">
    <h1>Uppdatera </h1>
  </div>


  <form method="POST" class="form mx-auto">

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
      <label for="img_url" class="form-label">Img_url</label>
      <input type="img_url" class="form-control" id="img_url" name="img_url" value="<?= htmlentities($product['img_url']) ?>">
    </div>


    <!-- Update Btn -->
    <input type="submit" class="btn btn-primary btn-form" name="updateAccountBtn" value="Uppdatera">

  </form>

  <?php 
include(LAYOUT_PATH_ADMIN . 'footer.php');
?>
