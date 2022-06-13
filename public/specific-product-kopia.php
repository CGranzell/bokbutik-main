<?php
require('../src/config.php');
include(LAYOUT_PATH . 'header.php');
// Hämtar en product
$product = $userDbHandler->fetchOneProduct($_GET['productID']);













// Felmeddelande sätts till tomma
$imgUrl 	= "";
$error 		= "";
$messages = "";

// debug($_POST);

if(isset($_POST['uploadBtn'])) {
	// debug($_FILES['uploadedFile']);
}


// Hela denna if sats är hantering av filen, kan brytas ut?
if(is_uploaded_file($_FILES['uploadedFile']['tmp_name'])){
			// This is the actual name of the file
		$fileName 		= $_FILES['uploadedFile']['name'];
		$fileType 		= $_FILES['uploadedFile']['type'];
		$fileTempPath = $_FILES['uploadedFile']['tmp_name'];
		$path 				= "../../bokbutik-main/public/img/";
		$newFilePath  = $path . $fileName;

		// Kan göras till konstant
		$allowedFileTypes = [
			'image/png',
			'image/jpeg',
			'image/gif',
		];

		$isFileTypeAllowed = array_search($fileType, $allowedFileTypes, true);

		// Kan brytas ut till funktioner
		if($isFileTypeAllowed == false) {
			$error .= 'The file type is invalid, Allowed types are pnj, jpeg and gif <br>';
		} 
		// Kan brytas ut till funktioner
		if($_FILES['uploadedFile']['size'] > 1000000 ){ // 1 MB
			$error .= 'Exceede filesize limit';
		}


			if(empty($error)) {

				$isTheFileUploaded = move_uploaded_file($fileTempPath, $newFilePath);
				if($isTheFileUploaded) {
						// Succes, the file is uploaded
						$imgUrl = $newFilePath;
					
				} else {
						// Could not upload the file
						$messages = 'Could not upload the file';
				}
			} 

			// Handle the rest of the form and save accordingly in DB
			// Validerar product title osv 
			// if all is validated , error is empty still, then perform the DB request
			if(empty($error)){
					// prepare-statement osv INSERT INTO / eller UPDATE
					$messages = 'Form was succesfully submitted';
				} else {
					$messages = $error;
				}

	
}

?>

 
      

      <div class="card card-specific mx-auto" style="width: 58rem;">
  <img src="<?=$imgUrl?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?= htmlentities($product['title']) ?></h5>
    <p class="card-text"><?= htmlentities($product['price']) ?></p>
    <p class="card-text"><?= htmlentities($product['stock']) ?></p>
    <p class="card-text"><?= htmlentities($product['description']) ?></p>
    <a href="#" class="btn btn-primary">Add to Cart</a>
  </div>
</div>



<form action="" method="POST" enctype="multipart/form-data">
		<!-- <label> ProductTitle:</label>
			<input type="text" name="productTitle"> -->

	<label>File: </label>
		<input type="file" name="uploadedFile">
		<input type="submit" value="upload" name="uploadBtn">
</form>

<?php 
include(LAYOUT_PATH . 'footer.php');
?>

