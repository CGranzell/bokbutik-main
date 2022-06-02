<?php
if (isset($_POST['deleteButton'])) { 
    
    
    $sql = "
        DELETE FROM products 
        WHERE id = :id;
    ";
    $stmt = $pdo->prepare($sql); 
    $stmt->bindParam(":id", $_POST['deleteButton']); 
    $stmt->execute(); // 
} 



// CREATE PRODUCTS

if (isset($_POST['addProduct'])) { 	
     
     $sql = "
        INSERT INTO products (title, description, price, stock) 
        VALUES (:title, :description, :price, :stock); 
    ";
     $stmt = $pdo->prepare($sql);
	 $stmt->bindParam(":title", $_POST['title']);
	 $stmt->bindParam(":description", $_POST['description']);
	 $stmt->bindParam(":price", $_POST['price']);
	 $stmt->bindParam(":stock", $_POST['stock']);
	 $stmt->execute(); 
}


//READ PRODUCTS

$stmt = $pdo->query("SELECT * FROM products"); 	
$products = $stmt->fetchAll(); 

?>


<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
</head>
<body>
	<h1>Admin page</h1>
	<p>
	
	<table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
				<th>Price</th>
				<th>Stock</th>
				
			</tr>
        </thead>
		<tbody>
	<?php foreach ($products as $product) : ?>	
                <tr>
                    <td><?=htmlentities($product['id']) ?></td>	 
                    <td><?=htmlentities($product['title']) ?></td>	
                    <td><?=htmlentities($product['description']) ?></td>
					<td><?=htmlentities($product['price']) ?></td>
					<td><?=htmlentities($product['stock']) ?></td>
								
					<td>
				<form action="" method="POST"> 
	
                           
						   <button>Delete product</button>
							<input type="hidden" name="deleteButton" value="<?=htmlentities($product['id']) ?>">
				</form>
					</td>
											
                    </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
      	

				<form action="" method="POST"> <br>
							<input type="text" name="title" placeholder="Title">     <p>
							<textarea name="description" rows="4" cols="50" placeholder="Description">  </textarea> <p>
							<input type="text" name="price" placeholder="Price"> <p>
							<input type="text" name="stock" placeholder="Stock"> <p>
							<input type="submit" name="addProduct" value="Add product"> 
		 
				</form> 

<p>
</body>
</html>
