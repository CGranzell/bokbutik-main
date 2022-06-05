<?php

require('../src/config.php');
include('../public/layout/header.php');




// $sql = "SELECT * FROM users";
// $statement = $dbconnect->query($sql);
// $users = $statement->fetchAll();

// echo "<pre>";
// print_r($users);
// echo "</pre>";

?>

  <h1>Register Here</h1>
	<!-- Registrerings formulär -->
<form>
		<!-- First Name -->
		<div class="mb-3">
    <label for="first-name" class="form-label">First Name</label>
    <input type="text" class="form-control" id="first-name">
  </div>
		<!-- Last Name -->
		<div class="mb-3">
    <label for="last-name" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="last-name">
  </div>
	<!-- Email -->
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control">
  </div>
	<!-- Password -->
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password">
  </div>
		<!-- Phone -->
		<div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="tel" class="form-control" id="phone">
  </div>
		<!-- Phone -->
		<div class="mb-3">
    <label for="street" class="form-label">Street</label>
    <input type="text" class="form-control" id="street">
  </div>
		<!-- Postal Code -->
		<div class="mb-3">
    <label for="postal_code" class="form-label">Postal Code</label>
    <input type="number" class="form-control" id="postal-code">
  </div>
		<!-- City -->
		<div class="mb-3">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" id="city">
  </div>
		<!-- Country -->
		<div class="mb-3">
    <label for="country" class="form-label">Country</label>
    <input type="text" class="form-control" id="counrty">
  </div>
  <!-- Create User Btn -->
  <input type="submit" class="btn btn-primary" name="createUserBtn" value="Register">

</form>

<?php 

include('../public/layout/footer.php');
?>