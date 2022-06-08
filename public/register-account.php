<?php
require('../src/config.php');
include('./layout/header.php');

// Felmeddelanden sätts till tomt
  $errorMessageFirstname  = "";
  $errorMessageLastname   = "";
  $errorMessageEmail      = "";
  $errorMessagePassword   = "";
  $errorMessagePhone      = "";
  $errorMessageStreet     = "";
  $errorMessagePostalcode = "";
  $errorMessageCity       = "";
  $errorMessageCountry    = ""; 
  $errorTakenEmail        = "";
  $message                = "";


// Skapa användaruppgift
if(isset($_POST['createUserBtn'])) {
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

    // Kollar om email är upptagen
    $emailExist = $userDbHandler->fetchUserByEmail($email);
 
  if($emailExist){
    $errorTakenEmail  = emailAlreadyTaken($errorTakenEmail);
  } else if($_POST['password'] !== $_POST['confirmPassword']) {
    $message = noMatchPassword($message);
  }
 
  else {
  // Om något av textfälten är tomma gå in i detta if block
  
  if (
    $firstname  === ""  ||
    $lastname   === ""  ||
    $email      === ""  ||  
    $password   === ""  ||
    $phone      === ""  ||
    $street     === ""  ||  
    $postalcode === ""  ||
    $city       === ""  ||
    $country    === ""  
  ) {
      // Felmeddelande Firstname
    if (empty($firstname)) {
      $errorMessageFirstname = errorRequiredField("Firstname");
    }
    // Felmeddelande Lastname
    if (empty($lastname)) {
      $errorMessageLastname =  errorRequiredField("Lastname");
    }
    // Felmeddelande Email
    if (empty($email)) {
      $errorMessageEmail = errorRequiredField("Email");
    }
    // Felmeddelande Password
    if (empty($password)) {
      $errorMessagePassword = errorRequiredField("Password");
    }
    // Felmeddelande Phone
    if (empty($phone)) {
      $errorMessagePhone = errorRequiredField("Phone");
    }
    // Felmeddelande Street
    if (empty($street)) {
      $errorMessageStreet = errorRequiredField("Street");
    }
    // Felmeddelande Postal Code
    if (empty($postalcode)) {
      $errorMessagePostalcode = errorRequiredField("Postal Code");
    }
    // Felmeddelande City 
    if (empty($city)) {
      $errorMessageCity  = errorRequiredField("City");
    }
    // Felmeddelande Country 
    if (empty($country)) {
      $errorMessageCountry  = errorRequiredField("Country");
    }
  } else {
    $userDbHandler->addUser($userInfo);
    redirect("login-account", "registerSuccess");   
    }
  }
}

?>

 <div class="wrapper-register">
  <h2>Register Here</h2>
  </div>
  <?= $message ?>
  <?= $errorTakenEmail ?>
	<!-- Registrerings formulär -->
<form method="POST" action="" class="form mx-auto">
		<!-- First Name -->
		<div class="mb-3">
    <label for="first-name" class="form-label">First Name</label>
    <?=$errorMessageFirstname  ?>
    <input type="text" class="form-control" id="first-name" name="first_name">
  </div>
		<!-- Last Name -->
		<div class="mb-3">
    <label for="last-name" class="form-label">Last Name</label>
    <?=$errorMessageLastname ?>
    <input type="text" class="form-control" id="last-name" name="last_name">
  </div>
	<!-- Email -->
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <?=$errorMessageEmail ?>
    <input type="email" class="form-control" name="email">
  </div>
	<!-- Password -->
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <?=$errorMessagePassword ?>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  	<!-- Confirm Password -->
    <div class="mb-3">
    <label for="confirm-password" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
  </div>
		<!-- Phone -->
		<div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <?=$errorMessagePhone ?>
    <input type="tel" class="form-control" id="phone" name="phone">
  </div>
		<!-- Street -->
		<div class="mb-3">
    <label for="street" class="form-label">Street</label>
    <?=$errorMessageStreet ?>
    <input type="text" class="form-control" id="street" name="street">
  </div>
		<!-- Postal Code -->
		<div class="mb-3">
    <label for="postal_code" class="form-label">Postal Code</label>
    <?=$errorMessagePostalcode ?>
    <input type="number" class="form-control" id="postal-code" name="postal_code">
  </div>
		<!-- City -->
		<div class="mb-3">
    <label for="city" class="form-label">City</label>
    <?=$errorMessageCity ?>
    <input type="text" class="form-control" id="city" name="city">
  </div>
		<!-- Country -->
		<div class="mb-3">
    <label for="country" class="form-label">Country</label>
    <?=$errorMessageCountry ?>
    <input type="text" class="form-control" id="counrty" name="country">
  </div>
  <!-- Create User Btn -->
  <input type="submit" class="btn btn-primary btn-form" name="createUserBtn" value="Register">


</form>

<footer id="footer" class="mt-auto  footer">


</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
