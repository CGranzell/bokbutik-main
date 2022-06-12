<?php
require('../src/config.php');
include('./layout/header.php');
?>

<?php

	$imgUrl   = "";
	$error    = "";
	$messages = "";
	
if (isset($_POST['uploadBtn'])) {
	
	if (is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) { //Har filen laddats upp?
	
		
		$fileName 	    = $_FILES['uploadedFile']['name'];
		$fileType 	    = $_FILES['uploadedFile']['type'];
		$fileTempPath   = $_FILES['uploadedFile']['tmp_name'];
		$path 		    = "img/";
		// uploads/dummy-profile.png
	$newFilePath = $path . $fileName; //sökvägen och namnet
	}

	if ($_FILES['uploadedFile']['size'] > 2000000) {  // Allows only files under 2 mbyte, 2 miljon byte
			$error .= 'Exceeded filesize limit.<br>';  
		}
		
		if (empty($error)) {
			$isTheFileUploaded = move_uploaded_file($fileTempPath, $newFilePath);
	
			if ($isTheFileUploaded) {
				// Success the file is uploaded
				$imgUrl = $newFilePath;
			} else {
				// Could not upload the file
				$error = "Could not upload the file";
			}
		}
	
	} //HÄR SLUTAR BILDHANTERINGEN


	if (isset($_POST['Readmore'])) {
    
    
		$sql = "
			SELECT * FROM products 
			WHERE id= :id;
		";
		$stmt = $pdo->prepare($sql); 
		$stmt->bindParam(":id", $_POST['id']); 
		$stmt->execute(); 
	} 
	
	$stmt = $dbconnect->query("SELECT * FROM `products` "); 	
	$products = $stmt->fetchAll(); 	//Hämtar produkterna
	
	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Den publika sidan</title>
    <link rel="stylesheet" href="css/style.css">
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
                    <td><?=htmlentities($product['title']) ?>
					
					
					<form action="specific-product.php" method="POST">
			    	<input type="hidden" name="Title" value="<?=$product['title']?>">
			        <input type="hidden" name="Description" value="<?=$product['description']?>">
			        <input type="hidden" name="Price" value="<?=$product['price']?>">
		          	<input type="hidden" name="Stock" value="<?=$product['stock']?>">
					<input type="hidden" name="Image" img src="<?=$imgUrl?>">
		            <input type="submit" name="Readmore" value="Specific product">
                    </form>
					</td>

				    <td><?=htmlentities($product['description']) ?></td>
                    <td><?=htmlentities($product['price']) ?></td>
                    <td><?=htmlentities($product['stock']) ?></td>
                   
					<td>  <img src="<?=$imgUrl?>"> </td>
                       
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>

		<form action="" method="POST" enctype="multipart/form-data"> <!--enctype för att $_FILES ska funka -->
        <label>File:</label> 
		  <input type="file" name="uploadedFile"><br> <!-- Type=file gör att man får en fil-knapp-->
		  <input type="submit" value="upload" name="uploadBtn"> <!--Uppladdningsknappen-->
	  </form>
	  <p>
	  <img src="<?=$imgUrl?>">

</body>
</html>
