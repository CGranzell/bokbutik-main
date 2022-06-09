<?php
//require('C:\MAMP\htdocs\bokbutik-main\src\dbconnect.php');
require('../../src/dbconnect.php');
//echo "<pre>";
//print_r($_GET['productId']);
//echo "</pre>";

// if(isset($_POST['updateProductBtn'])) {


//   $sql = "
//   UPDATE products
//   SET
//     title  = :title,
//     description   = :description,
//     price       = :price,
//     stock    = :stock,
//     img_url       = :img_url,


//   WHERE id = :id
//   ";
//   $statement = $dbconnect->prepare($sql);
//   $statement->bindParam(':id', $_GET['productId']);
//   $statement->bindParam(':title', $_POST['title']);
//   $statement->bindParam(':description', $_POST['description']);
//   $statement->bindParam(':price', $_POST['price']);
//   $statement->bindParam(':stock', $_POST['stock']);
//   $statement->bindParam(':img_url', $_POST['img_url']);
//   $statement->execute();

//  }

if (isset($_POST['deleteProductBtn'])) {

    $sql = "
        DELETE FROM products
        WHERE id = :id;
    ";
    $stmt = $dbconnect->prepare($sql);
    $stmt->bindParam(":id", $_POST['productId']);
    $stmt->execute();
}
if (isset($_POST['addProductBtn'])) {

	$sql = "
	   INSERT INTO products (title, description, price, stock,img_url)
	   VALUES (:title, :description, :price, :stock, :img_url);
   ";
	$stmt = $dbconnect->prepare($sql);
	$stmt->bindParam(":title", $_POST['title']);
	$stmt->bindParam(":description", $_POST['description']);
	$stmt->bindParam(":price", $_POST['price']);
	$stmt->bindParam(":stock", $_POST['stock']);
  $stmt->bindParam(":img_url", $_POST['img_url']);
  $stmt->execute();


}




$sql = "SELECT * FROM products";
$statement = $dbconnect->query($sql);
$products = $statement->fetchAll(); 
                   

$stmt       = $dbconnect->query("SELECT * FROM products");
$products  = $stmt->fetchAll();

echo "<pre>";
print_r($products);
echo "</pre>";
?> <?php $sql = "
SELECT * FROM products 
WHERE id = :id
";
$statement = $dbconnect->prepare($sql);
$statement->bindParam(':id', $_GET['productId']);
$statement->execute();
$product = $statement->fetch();

?>
<div class="wrapper-register">
  <h1>Uppdaterad produkt </h1>
  </div>
  
  <form method="GET" action="" class="form mx-auto" >
		
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
  </div></form>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ADMIN</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>


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

   <form action="" method="POST">
	   <input type="text" name="title" placeholder="Title"><br>
	   <input type="text" name="description" placeholder="Description"><br>
	   <input type="text" name="price" placeholder="Price"><br>
	   <input type="text" name="stock" placeholder="Stock"><br>
     <input type="text" name="img_url" placeholder="Img_url"><br>
	   <input type="submit" name="addProductBtn" value="Add product"><br>
   </form>


</body>
</html>
