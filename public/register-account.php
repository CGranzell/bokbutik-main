<?php
require('../src/config.php');
include('./layout/header.php');
// echo "POST";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

// echo "GET";
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

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
  //Tar bort mellanslag före och efter textsträng
  $firstname = trim($_POST['first_name']);
  $lastname = trim($_POST['last_name']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $phone = trim($_POST['phone']);
  $street = trim($_POST['street']);
  $postalcode = trim($_POST['postal_code']);
  $city = trim($_POST['city']);
  $country = trim($_POST['country']);

    // Kollar om email är upptagen
    $sql = '
    SELECT * FROM users
    WHERE email = :email
  ';
 
  $statement = $dbconnect->prepare($sql);
  $statement->bindParam(':email', $email);
  $statement->execute();
  $emailExist = $statement->fetch();
  // Om Email är upptagen
  if($emailExist){
    $errorTakenEmail  = '
   <div class="alert alert-danger message mx-auto">
      The email is already taken
   </div>
   ';
   
 } else {

 

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
      $errorMessageFirstname = '
      <div class="alert alert-danger message mx-auto">
        Firstname is required
      </div>
    ';
    }
    // Felmeddelande Lastname
    if (empty($lastname)) {
      $errorMessageLastname = '
      <div class="alert alert-danger message mx-auto">
      Lastname is required
      </div>
    ';
    }
    // Felmeddelande Email
    if (empty($email)) {
      $errorMessageEmail = '
      <div class="alert alert-danger message mx-auto">
      Email is required
      </div>
    ';
    }
    // Felmeddelande Password
    if (empty($password)) {
      $errorMessagePassword = '
      <div class="alert alert-danger message mx-auto">
      Password is required
      </div>
    ';
    }
    // Felmeddelande Phone
    if (empty($phone)) {
      $errorMessagePhone = '
      <div class="alert alert-danger message mx-auto">
      Phone is required
      </div>
    ';
    }
    // Felmeddelande Street
    if (empty($street)) {
      $errorMessageStreet = '
      <div class="alert alert-danger message mx-auto">
      Street is required
      </div>
    ';
    }
    // Felmeddelande Postal Code
    if (empty($postalcode)) {
      $errorMessagePostalcode = '
      <div class="alert alert-danger message mx-auto">
      Postal code is required
      </div>
    ';
    }
    // Felmeddelande City 
    if (empty($city)) {
      $errorMessageCity  = '
      <div class="alert alert-danger message mx-auto">
      City  is required
      </div>
    ';
    }
    // Felmeddelande Country 
    if (empty($country)) {
      $errorMessageCountry  = '
      <div class="alert alert-danger message mx-auto">
      Country is required
      </div>
    ';
    }
  } else {

    $sql = "
    INSERT INTO users 
     (
      first_name, 
      last_name,
      email,
      password,
      phone,
      street,
      postal_code,
      city,
      country
     )
     VALUES 
     (
      :first_name,
      :last_name,
      :email,
      :password,
      :phone,
      :street,
      :postal_code,
      :city,
      :country
     )
    ";
    $statement = $dbconnect->prepare($sql);
    $statement->bindParam(':first_name', $firstname);
    $statement->bindParam(':last_name', $lastname);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':password', $password);
    $statement->bindParam(':phone', $phone );
    $statement->bindParam(':street', $street);
    $statement->bindParam(':postal_code', $postalcode);
    $statement->bindParam(':city', $city);
    $statement->bindParam(':country', $country);
    $statement->execute();

    // OM password inte stämmer med confirmpassword, skriv ut felmeddelande
  if($_POST['password'] !== $_POST['confirmPassword']){
    $message = '
    <div class="alert alert-danger message mx-auto">
        The password do not match!
    </div>
    ';
  } else {

    header('Location: login-account.php?registerSuccess');
    exit;
  }
  }
}

}


?>


  

  
  
 
  
  <?= $message ?>
  <?= $errorTakenEmail ?>
 

  <h1>Register Here</h1>
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
