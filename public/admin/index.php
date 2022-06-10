<?php
//require('C:\MAMP\htdocs\bokbutik-main\src\dbconnect.php');
require('../../src/dbconnect.php');
//echo "<pre>";
//print_r($_GET['productId']);
//echo "</pre>";
$imgUrl= "";
$error = "";
$messages = "";

if (isset($_POST['uploadBtn'])) 
	echo "<pre>";
	print_r($_FILES['uploadedFile']);
	echo "</pre>";

  if (is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) {
    $fileName = $_FILES['uploadedFile']['name'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileTempPath = $_FILES['uploadedFile']['tmp_name'];
    $path ="img/";
    $newFilePath = $path . $fileName;

    $allowedFileTypes = [
      'image/png',
      'image/jpeg',
      'image/gif',
    ];
    $isFileTypeAllowed = array_search($fileType, $allowedFileTypes, true);
    
    if ($isFileTypeAllowed === false) {
      $error = "The file type is invalid. Allowed types are jpeg, png, gif. <br>";
    }

    if ($_FILES < 1000000) {
      $error .= 'Exceeded filesize limit.<br>';
    }

    $img_size = getimagesize($fileTempPath);

    //echo "<pre>";
    //print_r($img_size[0]);
    //echo "</pre>";

   // if (!$img_size[0] === 1000 && $img_size[1] === 200) {
     // $error = "Only execpts images that are 
     // 1000px wide and 200px in height ";
    //}

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
if (empty($error)) {}
}

if (isset($_POST['deleteProductBtn'])) {

    $sql = "
        DELETE FROM products
        WHERE id = :id;
    ";
    $stmt = $dbconnect->prepare($sql);
    $stmt->bindParam(":id", $_POST['productId']);
    $stmt->execute();
}
if (isset($_POST['addProductBtn'])) {

	$sql = "
	   INSERT INTO products (title, description, price, stock,img_url)
	   VALUES (:title, :description, :price, :stock, :img_url);
   ";
	$stmt = $dbconnect->prepare($sql);
	$stmt->bindParam(":title", $_POST['title']);
	$stmt->bindParam(":description", $_POST['description']);
	$stmt->bindParam(":price", $_POST['price']);
	$stmt->bindParam(":stock", $_POST['stock']);
  $stmt->bindParam(":img_url", $_POST['img_url']);
  $stmt->execute();


}



$stmt       = $dbconnect->query("SELECT * FROM products");
$products  = $stmt->fetchAll();
//echo "<pre>";
//print_r($products);
//echo "</pre>";


?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ADMIN</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>


<h1>Admin</h1>


   <table id="products-tbl">
	   <thead>
		   <tr>
			   <th>Title</th>
			   <th>Description</th>
			   <th>Price</th>
			   <th>Stock</th>
         <th>Img_url</th>


		   </tr>
	   </thead>

	   <tbody>
		   <?php

          foreach ($products as $product) { ?>
          <tr>

              <td><?=htmlentities($product['title']) ?></td>
              <td><?=htmlentities($product['description']) ?></td>
              <td><?=htmlentities($product['price']) ?></td>
              <td><?=htmlentities($product['stock']) ?></td>
              <td><?=htmlentities($product['img_url']) ?></td>


              <td>
              <form action="" method="POST">
                      <input type="hidden" name="productId" value="<?=$product['id'] ?>">
                      <input type="submit" name="deleteProductBtn" value="Delete"><br></form>



            <form action="update-product.php" method="GET">
                <input type="submit" value="Update">
                <input type="hidden" name="productId" value="<?= htmlentities($product['id']) ?>">
            </form>
          </td>
        </tr>
        <?php }?>
  </tbody>
</table>

   <form action="" method="POST">
	   <input type="text" name="title" placeholder="Title"><br>
	   <input type="text" name="description" placeholder="Description"><br>
	   <input type="text" name="price" placeholder="Price"><br>
	   <input type="text" name="stock" placeholder="Stock"><br>
     <input type="text" name="img_url" placeholder="Img_url"><br>
	   <input type="submit" name="addProductBtn" value="Add product"><br>
   </form>
   <?=$messages?>
   <form action="" method="POST" enctype="multipart/form-data">
	
		<input type="file" name="uploadedFile"><br>

		<input type="submit" value="upload" name="uploadBtn">
	</form>
  <img src="<?=$imgUrl?>">
</body>
</html>