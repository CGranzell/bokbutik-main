<?php

 // require('C:\MAMP\htdocs\eshop\bokbutik-main\src\dbconnect.php');
 require('../src/config.php');  //hänvisar till mappen ovanför'
 include('./layout/header.php');


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
  
	<link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="<?=CSS_PATH . 'style.css'?>">
  <title>Specific product</title>
	
</head>


<body>


        <p>
      <h1 class="fredriks-huvudrubrik">Shop page</h1>
      <h2 class="fredriks-underrubrik"> Specific product </h2>
        <p>
      
      
<div class="tabell">
<b> Title: </b>: <?php echo $_POST["Title"]; ?> <p> <p> <p>
<b> Description: </b> <?php echo $_POST["Description"]; ?><p>
<b> Price: </b> <?php echo $_POST["Price"]; ?><p>
<b> Stock: </b> <?php echo $_POST["Stock"]; ?><p>
<b> Image: </b> <?php echo $_POST["Stock"]; ?><p> 
</div>
<!-- Infoga en större bild här på produkten -->


<p>
<p>
<a href="index.php"> Till Shop page </a>


</body>
</html>
    