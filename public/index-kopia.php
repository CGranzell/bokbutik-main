<?php
require('../src/config.php');
include(LAYOUT_PATH . 'header.php');

//CONNECT TO READ-MORE BUTTON
if (isset($_POST['Readmore'])) {
 $userDbHandler->fetchOneProduct($_POST['id']);
} 
//READ 
$products = $userDbHandler->fetchAllProducts();
?>



	<h1 class="fredriks-huvudrubrik">Welcome to the Bok Store</h1>
	<h3 class="fredriks-huvudrubrik">Our selection</h3>
   <!-- Container rows -->
   <?php foreach ($products as $product) : ?>
    <div class="container-index">
		
      <div class="card  card-index" style="width: 18rem;">
        <img src="<?=htmlentities($product['img_url']) ?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?=htmlentities($product['title']) ?></h5>
        <p class="card-text">Price: <?=htmlentities($product['price']) ?> $</p>
        <p class="card-text">In stock: <i><?=htmlentities($product['stock']) ?></i></p>
        <div class="description-wrapper">
          <p class="card-text">About the book: <br> "<?= substr( htmlentities($product['description']), 0, 100) ?>"</p>

        </div>

				<form action="specific-product-kopia.php" method="GET">
        <input type="submit" value="Read more" class="btn btn-primary">
        <input type="hidden" name="productID" value="<?= htmlentities($product['id']) ?>">
      </form>
    </div>
  </div>
</div>
<?php endforeach ?>


        <!--Bildhantering nedan-->
        <?php

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
		$path 		    = "img/";
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



		/** 
		 * File size error handling
		 */
		if ($_FILES['uploadedFile']['size'] > 1000000) {  // Allows only files under 1 mbyte, 1 miljon byte
			$error .= 'Exceeded filesize limit.<br>';  
		}





		/**
		 * Image dimension error handling
		 */
		


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
  if (empty($error)) { //om något av felen $error inträffat ovan
		// INSERT INTO/ UPDATE

		$message = "Form was successfully submitted";
	} else {
		$message = $error;
	}
}
?>

        


      <h1> File upload </h1>
      <?=$message?>
        <p>
        <form action="" method="POST" enctype="multipart/form-data"> <!--enctype för att $_FILES ska funka -->
        <label>File:</label> 
		  <input type="file" name="uploadedFile"><br> <!-- Type=file gör att man får en fil-knapp-->
		  <input type="submit" value="upload" name="uploadBtn">
	  </form>
    <p>
    <img src="<?=$imgUrl?>">
    
    <p>
    
		<?php 
include(LAYOUT_PATH . 'footer.php');
?>
