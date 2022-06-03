<?php
require('../src/config.php');
echo "POST";
echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "GET";
echo "<pre>";
print_r($_GET);
echo "</pre>";



// Uppdatera användaruppgift
if(isset($_POST['updateAccountBtn'])) {
  $sql = "
  UPDATE users 
  SET 
    first_name  = :first_name,
    last_name   = :last_name,
    email       = :email,
    password    = :password,
    phone       = :phone,
    street      = :street,
    postal_code = :postal_code,
    city        = :city,
    country     = :country
  
  WHERE id = :id
  ";
  $statement = $dbconnect->prepare($sql);
  $statement->bindParam(':id', $_GET['userID']);
  $statement->bindParam(':first_name', $_POST['first_name']);
  $statement->bindParam(':last_name', $_POST['last_name']);
  $statement->bindParam(':email', $_POST['email']);
  $statement->bindParam(':password', $_POST['password']);
  $statement->bindParam(':phone', $_POST['phone']);
  $statement->bindParam(':street', $_POST['street']);
  $statement->bindParam(':postal_code', $_POST['postal_code']);
  $statement->bindParam(':city', $_POST['city']);
  $statement->bindParam(':country', $_POST['country']);
  $statement->execute();
}



// Hämtar en användaruppgift
$sql = "
      SELECT * FROM users 
      WHERE id = :id
";
$statement = $dbconnect->prepare($sql);
$statement->bindParam(':id', $_GET['userID']);
$statement->execute();
$user = $statement->fetch();

echo "User";
echo "<pre>";
print_r($user);
echo "</pre>";



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <title>Updatera mina sidor</title>
</head>
<body>
  <h1>Updatera mina sidor</h1>

  	<!-- Updatering formulär -->
<form method="POST" action="#">
		<!-- First Name -->
		<div class="mb-3">
    <label for="first-name" class="form-label">First Name</label>
    <input type="text" class="form-control" id="first-name" name="first_name" value="<?= htmlentities($user['first_name']) ?> ">
  </div>
		<!-- Last Name -->
		<div class="mb-3">
    <label for="last-name" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="last-name" name="last_name" value="<?= htmlentities($user['last_name']) ?>">
  </div>
	<!-- Email -->
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" value="<?= htmlentities($user['email']) ?>">
  </div>
	<!-- Password -->
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" value="<?= htmlentities($user['password']) ?>">
  </div>
		<!-- Phone -->
		<div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="tel" class="form-control" id="phone" name="phone" value="<?= htmlentities($user['phone']) ?>">
  </div>
		<!-- Street -->
		<div class="mb-3">
    <label for="street" class="form-label">Street</label>
    <input type="text" class="form-control" id="street" name="street" value="<?= htmlentities($user['street']) ?>">
  </div>
		<!-- Postal Code -->
		<div class="mb-3">
    <label for="postal_code" class="form-label">Postal Code</label>
    <input type="number" class="form-control" id="postal-code" name="postal_code" value="<?= htmlentities($user['postal_code']) ?>">
  </div>
		<!-- City -->
		<div class="mb-3">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" id="city" name="city" value="<?= htmlentities($user['city']) ?>">
  </div>
		<!-- Country -->
		<div class="mb-3">
    <label for="country" class="form-label">Country</label>
    <input type="text" class="form-control" id="counrty" name="country" value="<?= htmlentities($user['country']) ?>">
  </div>
  <!-- Update Btn -->
  <input type="submit" class="btn btn-primary" name="updateAccountBtn" value="Updatera">

</form>
  
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>