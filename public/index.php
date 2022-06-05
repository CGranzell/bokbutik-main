
<?php

 require('C:\MAMP\htdocs\eshop\bokbutik-main\src\dbconnect.php');
//READ PRODUCTS

$stmt = $dbconnect->query("SELECT * FROM products"); 	
$products = $stmt->fetchAll(); 

?>


<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
</head>
<body>
	<h1>Public page/Shop</h1>
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
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
     		

<p>
</body>
</html>
