<?php

require('../src/dbconnect.php');
//include('./layout/header.php');
//READ

$stmt = $pdo->query("SELECT * FROM products");
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
<body class="fredriks-body">

    <p>
	<h1 class="fredriks-huvudrubrik">Shop page</h1>
	<p>

	<table id="fredriks-tbl">

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


<!-- FILHANTERING AV BILDER -->

        <?php
echo "<pre>";
print_r($_POST);
echo "</pre>";


$imgUrl   = "";
$error    = "";
$message = "";
if (isset($_POST['uploadBtn'])) { 
//*Snappar upp de filer som skickats via FILES när jag trycker på uppdatera, 
 //  dvs. den fil som jag  valt och laddat upp.
	echo "<pre>";
	print_r($_FILES['uploadedFile']);	
	echo "</pre>";

	// [uploadedFile] => Array
    //     (
    //         [name] => dummy-profile.png
    //         [type] => image/png
    //         [tmp_name] => /Applications/MAMP/tmp/php/phpke9Trg   Filen laddades upp på ett ställe, men sparas nu temporärt
    //         [error] => 0
    //         [size] => 15076
    //     )
	//  print_r($_FILES[uploadedFile])= Nu är förälderarrayen uploadedFile borta.

	if (is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) { //Har filen laddats upp?
	//uploadedFile är förälderarrayen, tmp_name är barnarrayen
		
		$fileName 	    = $_FILES['uploadedFile']['name'];
		$fileType 	    = $_FILES['uploadedFile']['type'];
		$fileTempPath   = $_FILES['uploadedFile']['tmp_name'];
		$path 		    = "uploads/";
		// uploads/dummy-profile.png
		$newFilePath = $path . $fileName; //sökvägen och namnet
//Nu har filen flyttats från den temporära platsen till mappen uploads. 


		/**
		 * File type error handling
		 */
		$allowedFileTypes = [
			'image/png',
			'image/jpeg',
			'image/gif',
		];
		
		$isFileTypeAllowed = array_search($fileType, $allowedFileTypes, true); //image/png, den nya sökvägen
		if ($isFileTypeAllowed === false) {
			$error .= "The file type is invalid. Allowed types are jpeg, png, gif. <br>";
		}



		/** KOMMENTAR: Sibars kod funkade inte, min gör det! 
		 * File size error handling
		 */
		if ($_FILES['uploadedFile']['size'] > 1000000) {  // Allows only files under 1 mbyte, 1 miljon byte
			$error .= 'Exceeded filesize limit.<br>';  
		}





		/**
		 * Image dimension error handling
		 */
		$img_size = getimagesize($fileTempPath);
		 echo "<pre>";
		 print_r($img_size);
		 echo "</pre>";
		 if ( !($img_size[0] == 1000 && $img_size[1] == 200) ) {  // 0=width, 1=height
		 	$error .= "Only expects images that are 1000px in width and 200px in height";
		 }


		if (empty($error)) { //Har filen laddats upp till mappen uploads från den temporära platsen?
			$isTheFileUploaded = move_uploaded_file($fileTempPath, $newFilePath);  
	
			if ($isTheFileUploaded) {
				// Success the file is uploaded
				$imgUrl = $newFilePath;
			} else {
				// Could not upload the file
				$error = "Could not upload the file";
			}
		}
	}


	// Handle the rest of the form and save accordingly in DB
	// If all is validated, and error is empty still, then perform the DB request
	if (empty($error)) { //om något av felen $error inträffat ovan
		// INSERT INTO/ UPDATE

		$message = "Form was successfully submitted";
	} else {
		$message = $error;
	}
}
?>

<h1>File upload</h1>

	<?=$message?> <!-- Se rad 9, 97 -->

	<form action="" method="POST" enctype="multipart/form-data">
		<!-- <label>Product title:</label> 
		<input type="text" name="productTitle"><br>
 -->

		<label>File:</label> 
		<input type="file" name="uploadedFile" ><br> <!-- Type=file gör av får en fil-knapp-->
	<!--	<input type="text" value="Tom" name="topGun"> -->
		<input type="submit" value="upload" name="uploadBtn">  <!--Uppladdningsknappen-->
	</form>

	<img src="<?=$imgUrl?>">




        





</body>
</html>
