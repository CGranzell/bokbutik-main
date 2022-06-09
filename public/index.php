<?php
require('../src/config.php');
include('./layout/header.php');

//CONNECT TO READ-MORE BUTTON
if (isset($_POST['Readmore'])) {
    
    
  $sql = "
      SELECT * FROM products
      WHERE id= :id;
  ";
  $stmt = $pdo->prepare($sql); 
  $stmt->bindParam(":id", $_POST['id']); 
  $stmt->execute(); 
} 


//READ 

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
  <title>All products</title>
	
</head>
<body>

    <p>
	<h1 class="fredriks-huvudrubrik">Shop page</h1>
	<p>

	<table id="fredriks-tbl" class="fredriks-centrering">
     
            <tr><thead> 
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
				        <th>Price</th>
				        <th>Stock</th>
                <th> Image </th>


		      	</tr>
        </thead>
		<tbody>
	<?php foreach ($products as $product) : ?>
                <tr>
                    <td><?=htmlentities($product['id']) ?></td>
                    <td><?=htmlentities($product['title']) ?></td>
                    <td><?=htmlentities($product['description']) ?></td> 
                    <td><?=htmlentities($product['price']) ?></td>
                    <td><?=htmlentities($product['stock']) ?>
                   
                  <form action="specific-product.php" method="POST">
			            <input type="hidden" name="Title" value="<?=$product['title']?>">
			            <input type="hidden" name="Description" value="<?=$product['description']?>">
			          <input type="hidden" name="Price" value="<?=$product['price']?>">
		          	<input type="hidden" name="Stock" value="<?=$product['stock']?>">
                <input type="hidden" name="Image" value="<?=$product['img_url']?>">
		           <input type="submit" name="Readmore" value="Specific product">
                </form>
              </td>
              <td> <?=htmlentities($product['img_url']) ?> </td>
                       
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>


        <!--Bildhantering nedan-->
        <?php 
   echo "<pre>";
	print_r($_POST);
	echo "</pre>";

  echo "<p>";
  echo "<p>";
  $imgUrl   = "";
  $error    = "";
  $message = "";

  if (isset($_POST['uploadBtn'])) { 
    echo "<pre>";
    print_r($_FILES['uploadedFile']);	/*Lyssnar efter de filer som skickats via FILES, 
    dvs. när jag  valt fil och laddat upp. 
    
     print_r($_FILES[uploadedFile]); Nu är förälderarrayen uploadedFile borta.*/ 
    //Målet är att flytta filen från den temporära platsen till mappen uploads, när jag  hämtat och laddat upp filen. 
    echo "</pre>";}

    if (is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) { //har filen laddadts upp? uploadedFile
    //är förälderarrayen, tmp_name är barnarrayen
      
      $fileName 	    = $_FILES['uploadedFile']['name']; //// This is the name of the file
      $fileType 	    = $_FILES['uploadedFile']['type'];
      $fileTempPath   = $_FILES['uploadedFile']['tmp_name'];
      $path 		    = "img/";
      // uploads/dummy-profile.png  :mappen som jag vill spara den nedladdade filen i
      $newFilePath = $path . $fileName; }
     
  ?>

        <p>
        <form action="" method="POST" enctype="multipart/form-data"> <!--enctype för att $_FILES ska funka -->
        <label>File:</label> 
		  <input type="file" name="uploadedFile"><br> <!-- Type=file gör att man får en fil-knapp-->
		  <input type="submit" value="upload" name="uploadBtn">
	  </form>

    
    <p>
    

    
  
	
</body>
</html>
