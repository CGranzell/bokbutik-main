<?php
require('C:\MAMP\htdocs\bokbutik-main\src\dbconnect.php');
//echo "<pre>";
//print_r($_POST);    
//echo "</pre>";
if(isset($_GET['updateSucces'])){
  $succesMessage = '
  <div class="alert alert-success message mx-auto">
      Succes! The product was updated
  </div>;
';
}
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



$stmt       = $dbconnect->query("SELECT * FROM products"); 
$products  = $stmt->fetchAll();                      
echo "<pre>";
print_r($products);
echo "</pre>";


?>




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




	
</body>
</html>