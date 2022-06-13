<?php
require('../src/config.php');
include(LAYOUT_PATH . 'header.php');

//CONNECT TO READ-MORE BUTTON
if (isset($_POST['Readmore'])) {
 $userDbHandler->fetchOneProduct($_POST['id']);
} 
//READ 
$products = $userDbHandler->fetchAllProducts();

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

		// File size error handling
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
		// File size error handling
		if($_FILES['uploadedFile']['size'] > 1000000 ){ // 1 MB
			$error .= 'Exceede filesize limit';
		}


		// Images dimension error handling
		$img_size = getimagesize($fileTempPath);
		// debug($img_size[0]);

		if($isFileTypeAllowed 
					&& !$img_size[0] === 1000 
					&& $img_size[1] === 200) {
						$error = "Only execepts images that are 1000px wide and 200 px in height";
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


	<h1 class="fredriks-huvudrubrik">Welcome to the Bok Store</h1>
	<h3 class="fredriks-huvudrubrik">Our selection</h3>
   <!-- Container rows -->
   <?php foreach ($products as $product) : ?>
    <div class="container-index">
		
      <div class="card  card-index" style="width: 18rem;">
        <!-- <img src="<?=htmlentities($product['$imgUrl']) ?>" class="card-img-top" alt="..."> -->
        <!-- <img src="<?=$imgUrl?>" class="card-img-top" alt="..."> -->
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

<form action="" method="POST" enctype="multipart/form-data">
		<!-- <label> ProductTitle:</label>
			<input type="text" name="productTitle"> -->

	<label>File: </label>
		<input type="file" name="uploadedFile">
		<input type="submit" value="upload" name="uploadBtn">
</form>
    <?=$messages?>
		<?php 
include(LAYOUT_PATH . 'footer.php');
?>
