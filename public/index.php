<?php
require('../src/config.php');
//READ 

$stmt = $dbconnect->query("SELECT * FROM products"); 	
$products = $stmt->fetchAll(); 	
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=CSS_PATH . 'style.css'?>">
	<link rel="stylesheet" href="css/style.css">
    <title>Shop page</title>

</head>


<body id="body">

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
    <a class="nav-link" href="./register-account.php">Register</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./login-account.php">Login</a>
  </li>

</ul>
</nav>





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
	include('../public/layout/footer.php');
	?>
</body>
</html>
