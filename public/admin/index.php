<?php
require('C:\MAMP\htdocs\bokbutik-main\src\dbconnect.php');
//echo "<pre>";
//print_r($_POST);    
//echo "</pre>";
if (isset($_POST['deleteProductBtn'])) {
    
    $sql = "
        DELETE FROM products
        WHERE id = :id;
    ";
    $stmt = $dbconnect->prepare($sql);
    $stmt->bindParam(":id", $_POST['id']);
    $stmt->execute(); 
} 
if (isset($_POST['addProductBtn'])) {
	
	$sql = "
	   INSERT INTO products (title, description, price, stock) 
	   VALUES (:title, :description, :price, :stock);
   ";
	$stmt = $dbconnect->prepare($sql);
	$stmt->bindParam(":title", $_POST['title']);
	$stmt->bindParam(":description", $_POST['description']);
	$stmt->bindParam(":price", $_POST['price']);
	$stmt->bindParam(":stock", $_POST['stock']);
	
	
}




$stmt       = $dbconnect->query("SELECT * FROM products"); 
$products  = $stmt->fetchAll();                      
echo "<pre>";
print_r($_POST);
echo "</pre>";


?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>PDO intro</title>
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
			   
			   
		   </tr>
	   </thead>

	   <tbody>
		   <?php 
			   
			    foreach ($products as $product)  ?>
                <tr>
                    
                    <td><?=htmlentities($products['title']) ?></td>
                    <td><?=htmlentities($products['description']) ?></td>
                    <td><?=htmlentities($products['price']) ?></td>
					<td><?=htmlentities($products['stock']) ?></td>
					
                    
                    
                    <td>
					   <form action="" method="POST">
					   <input type="hidden" name="productId" value="<?=$products['id'] ?>
						   <button>Delete</button>
					   </form>
				   </td>
			   </tr>
		   
	   </tbody>
   </table>
   
   <form action="" method="POST">
	   <input type="text" name="title" placeholder="Title"><br>
	   <input type="text" name="description" placeholder="Description"><br>
	   <input type="text" name="price" placeholder="Price"><br>
	   <input type="text" name="stock" placeholder="Stock"><br>
	   <input type="submit" name="addProductBtn" value="Add product"><br>
   </form>

   
</body>
</html>




	
</body>
</html>