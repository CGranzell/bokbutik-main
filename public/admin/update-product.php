<?php
require('../../src/config.php');
include(LAYOUT_PATH_ADMIN . 'header-admin.php');


$imgUrl = "";
$error = "";
$messages = "";


if(isset($_POST['updateAccountBtn'])) {


// If they upload a new file
  if (is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) {
    $fileName = $_FILES['uploadedFile']['name'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileTempPath = $_FILES['uploadedFile']['tmp_name'];

    $path = 'img/';
    // $path ="img/";
    $newFilePath = $path . $fileName;

    $allowedFileTypes = [
      'image/png',
      'image/jpeg',
      'image/gif',
      'image/jpg',
    ];
    $isFileTypeAllowed = array_search($fileType, $allowedFileTypes, true);


    if ($isFileTypeAllowed === false) {
      $error = "The file type is invalid. Allowed types are jpeg, png, gif. <br>";
    }

    if ($_FILES['uploadedFile']['size'] > 1000000) {
      $error .= 'Exceeded filesize limit.<br>';
    }

    if (empty($error)) {


      $isTheFileUploaded = move_uploaded_file($fileTempPath, $newFilePath);

      if ($isTheFileUploaded) {
        $imgUrl = $newFilePath;
        $messages = "Upload success";
      } else {
        $error = "Could not upload the file";
      }
    } else {
      $messages = $error;
    }

    $productInfo = [
      $title       = trim($_POST['title']),
      $description = trim($_POST['description']),
      $price       = trim($_POST['price']),
      $stock       = trim($_POST['stock']),
      $img_url     = trim($imgUrl)

    ];
    $update = $userDbHandler->updateProduct($_GET['productId'], $productInfo);

  } else {

    // If they dont upload a new file

    $productInfo = [
      $title       = trim($_POST['title']),
      $description = trim($_POST['description']),
      $price       = trim($_POST['price']),
      $stock       = trim($_POST['stock']),
      $img_url     =trim($_POST['img_url']),

    ];
    $update = $userDbHandler->updateProduct($_GET['productId'], $productInfo);

  }

      redirect("index", "updateSucces");

}


$product = $userDbHandler->fetchOneProduct($_GET['productId']);
?>


  <div class="wrapper-register">
    <h1>Uppdatera </h1>
  </div>


  <form method="POST" action="" enctype="multipart/form-data" class="form mx-auto">

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="<?= htmlentities($product['title']) ?> ">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <input type="description" class="form-control" id="description" name="description" value="<?= htmlentities($product['description']) ?>">
    </div>

    <div class="mb-3">
      <label for="price" class="form-label">Price</label>
      <input type="text" class="form-control" id="price" name="price" value="<?= htmlentities($product['price']) ?>">
    </div>

    <div class="mb-3">
      <label for="stock" class="form-label">Stock</label>
      <input type="stock" class="form-control" name="stock" value="<?= htmlentities($product['stock']) ?>">
    </div>

    <div class="mb-3">
      <label for="img_url" class="form-label">Image</label><br>
      <input type="hidden" id="img_url" name="img_url" value="<?= htmlentities($product['img_url']) ?>"> <img src="<?=($product['img_url'])?>">
      <div class="mb-3" id="inputBtn">
        <input type="file" name="uploadedFile" ><br>
    </div>


    <!-- Update Btn -->
    <input type="submit" class="btn btn-primary btn-form" name="updateAccountBtn" value="Uppdatera">

  </form>

  <?php
include(LAYOUT_PATH_ADMIN . 'footer.php');
?>

