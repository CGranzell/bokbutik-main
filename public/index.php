
<?php

 // require('C:\MAMP\htdocs\eshop\bokbutik-main\src\dbconnect.php');
 require('../src/config.php'); //hänvisar till mappen ovanför
 include('../public/layout/header.php');
 
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


    <p>
	<h1 class="fredriks-huvudrubrik">Shop page</h1>
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
                    <td> 
		<?=
			$string = $product['description'];
			
			echo substr($string, 0, 50);
			?>
			
			<form action="specific-product.php" method="POST">
			<input type="hidden" name="Title" value="<?=$product['title']?>">
			<input type="hidden" name="Description" value="<?=$product['description']?>">
			<input type="hidden" name="Price" value="<?=$product['price']?>">
			<input type="hidden" name="Stock" value="<?=$product['stock']?>">
		    <input type="submit" name="Readmore" value="Detailed info"> 
			</form>
									
		</td>
					<td><?=htmlentities($product['price']) ?></td>
					<td><?=htmlentities($product['stock']) ?></td>					
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    
	<?php
	include('../public/layout/header.php');
	?>
</body>
</html>

