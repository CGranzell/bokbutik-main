<?php
require('../src/config.php');
require('../src/app/user_functions.php');
require('../src/app/common_functions.php');
include('./layout/header.php');


// Lösenordsskyddad, om SESSION inte är satt från login kan användaren inte komma åt sidan
checkLoginSession();

// Om inte userID är satt eller är ett nummer, skicka användaren till my-account med querystring invalidUser
if(!isset($_GET['userID']) || !is_numeric($_GET['userID'])){
  redirect("my-account", "invalidUser");
};


// Felmeddelande sätts till tomt
$message = "";
// Uppdatera användaruppgift
if(isset($_POST['updateAccountBtn'])) {
  if($_POST['password'] !== $_POST['confirmPassword']){
    $message = noMatchPassword($message);
  } else {
       // skapar och fyller array med user info
    $userInfo = [
    //Tar bort mellanslag före och efter textsträng
    $firstname  = trim($_POST['first_name']),
    $lastname   = trim($_POST['last_name']),
    $email      = trim($_POST['email']),
    $password   = trim($_POST['password']),
    $phone      = trim($_POST['phone']),
    $street     = trim($_POST['street']),
    $postalcode = trim($_POST['postal_code']),
    $city       = trim($_POST['city']),
    $country    = trim($_POST['country']),
  ];
    updateUser($_GET['userID'], $userInfo);
    redirect("my-account", "updateSucces");
  }


}
// Hämtar en user
$user = fetchOneUser($_GET['userID']);

?>

<div class="wrapper-register">
  <h1>Uppdatera mina sidor</h1>
  </div>
  <?=$message ?>

  	<!-- Updatering formulär -->
  <form method="POST" action="#" class="form mx-auto" >
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
	<!-- Confirm Password -->
  <div class="mb-3">
    <label for="confirm-password" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
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
  <input type="submit" class="btn btn-primary btn-form" name="updateAccountBtn" value="Uppdatera">

</form>


  
<footer id="footer" class="mt-auto  footer">


</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
