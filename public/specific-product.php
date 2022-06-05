<?php

 // require('C:\MAMP\htdocs\eshop\bokbutik-main\src\dbconnect.php');
 require('../src/config.php');  //hänvisar till mappen ovanför
 include('../public/layout/header.php');
 
//READ PRODUCTS

$stmt = $dbconnect->query("SELECT * FROM products"); 	
$products = $stmt->fetchAll(); 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specific product</title>
	<link rel="stylesheet" href="css/style.css">
    
</head>
<body>

<p>
	<h1 class="fredriks-huvudrubrik">Shop page</h1>
<p>

<b> Title: </b>: <?php echo $_POST["Title"]; ?><p>
<b> Description: </b> <?php echo $_POST["Description"]; ?><p>
<b> Price: </b> <?php echo $_POST["Price"]; ?><p>
<b> Stock: </b> <?php echo $_POST["Stock"]; ?><p>


<p>
<p>
<a href="index.php"> Till Shop page </a>


</body>
</html>
    