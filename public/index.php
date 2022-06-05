
<?php

 // require('C:\MAMP\htdocs\eshop\bokbutik-main\src\dbconnect.php');
 require('../src/config.php');
 
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
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
	
</head>
<body>
<nav class="navbar-light" style="background-color: #e3f2fd;">
<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>
</nav>

    <p>
	<h1 class="fredriks-huvudrubrik">Public page/Shop</h1>
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
     		

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>

