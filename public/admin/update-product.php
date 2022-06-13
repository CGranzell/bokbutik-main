<?php
//require('C:\MAMP\htdocs\bokbutik-main\src\dbconnect.php');
require('../../src/dbconnect.php');


$productId = $_GET['productId'];
// Felmeddelande sätts till tomt
// Uppdatera användaruppgift
if (array_key_exists('updateAccountBtn', $_POST)) {


  $sql = "
    UPDATE products
    SET
      title=:title,
      description=:description,
      price=:price,
      stock=:stock,
      img_url=:img_url
    WHERE id =:id
    ";
  $statement = $dbconnect->prepare($sql);
  $statement->bindParam(':id', $productId);
  $statement->bindParam(':title', $_POST['title']);
  $statement->bindParam(':price', $_POST['price']);
  $statement->bindParam(':description', $_POST['description']);
  $statement->bindParam(':stock', $_POST['stock']);
  $statement->bindParam(':img_url', $_POST['img_url']);
  $statement->execute();

  if ($sql) header('Location: http://localhost/bokbutik-main/public/admin/index.php') ;
}






// Hämtar en användaruppgift
$sql = "
      SELECT * FROM products
      WHERE id = :id
";
$statement = $dbconnect->prepare($sql);
$statement->bindParam(':id', $_GET['productId']);
$statement->execute();
$product = $statement->fetch();

//echo "Product";
//echo "<pre>";
//print_r($product);
//echo "</pre>";



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>



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
      <label for="img_url" class="form-label"></label>
      <input type="hidden" class="form-control" id="img_url" name="img_url" value="<?= htmlentities($product['img_url']) ?>">
    </div>


    <!-- Update Btn -->
    <input type="submit" class="btn btn-primary btn-form" name="updateAccountBtn" value="Uppdatera">

  </form>

</body>

</html>
