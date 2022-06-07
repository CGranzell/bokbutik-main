<?php

 // require('C:\MAMP\htdocs\eshop\bokbutik-main\src\dbconnect.php');
 require('../src/config.php');  //hänvisar till mappen ovanför'
 include('./layout/header.php');


 //READ PRODUCTS

$stmt = $dbconnect->query("SELECT * FROM products"); 	
$products = $stmt->fetchAll(); 

?>


  <html>
        <p>
      <h1 class="fredriks-huvudrubrik">Shop page</h1>
      <h2 class="fredriks-underrubrik"> Specific product </h2>
        <p>
      
      

<b> Title: </b>: <?php echo $_POST["Title"]; ?> <p> <p> <p>
<b> Description: </b> <?php echo $_POST["Description"]; ?><p>
<b> Price: </b> <?php echo $_POST["Price"]; ?><p>
<b> Stock: </b> <?php echo $_POST["Stock"]; ?><p>
<!-- Infoga en större bild här på produkten -->


<p>
<p>
<a href="index.php"> Till Shop page </a>


</body>
</html>
    