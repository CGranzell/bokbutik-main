
<?php

 require('C:\MAMP\htdocs\eshop\bokbutik-main\src\dbconnect.php');
 
//READ PRODUCTS

$stmt = $dbconnect->query("SELECT * FROM products"); 	
$products = $stmt->fetchAll(); 

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop page</title>
    <link rel="stylesheet" href="css/style.css">
	
</head>
<body>
	<h1>Public page/Shop</h1>
	<p>
	
	<table id="fredriks-tbl">
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

