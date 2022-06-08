<?php

 // require('C:\MAMP\htdocs\eshop\bokbutik-main\src\dbconnect.php');
 require('../src/config.php');  //hänvisar till mappen ovanför'
 include('./layout/header.php');


 //READ PRODUCTS

$stmt = $dbconnect->query("SELECT * FROM products");
$products = $stmt->fetchAll();

?>

<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=CSS_PATH . 'style.css'?>">
	<link rel="stylesheet" href="css/style.css">
    <title>Specific product</title>

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



  <!-- Här slutar header -->
  <html>
        <p>
      <h1 class="fredriks-huvudrubrik">Shop page</h1>
      <h2 class="fredriks-huvudrubrik"> Specific product </h2>
        <p>


<div id="fredriks-content">
<b> Title: </b>: <?php echo $_POST["Title"]; ?> <p> <p> <p>
<b> Description: </b> <?php echo $_POST["Description"]; ?><p>
<b> Price: </b> <?php echo $_POST["Price"]; ?><p>
<b> Stock: </b> <?php echo $_POST["Stock"]; ?><p>
<!-- Infoga en större bild här på produkten -->


<p>
<p>
<a href="index.php"> Till Shop page </a>
</div>

</body>
</html>
