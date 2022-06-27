<?php
require('../src/config.php');
include(LAYOUT_PATH . 'header-public.php');

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

// Skapa användaruppgift
if(isset($_POST['createOrderBtn'])) {

  //Tar bort mellanslag före och efter textsträng
  $firstname  = trim($_POST['first_name']);
  $lastname   = trim($_POST['last_name']);
  $email      = trim($_POST['email']);
  $password   = trim($_POST['password']);
  $phone      = trim($_POST['phone']);
  $street     = trim($_POST['street']);
  $postalcode = trim($_POST['postal_code']);
  $city       = trim($_POST['city']);
  $country    = trim($_POST['country']);
 
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
    redirectNoMessage("order-confirmation");   
  }
}
 $cartItemCount = count($_SESSION['cartItems']);
$cartTotalSum = 0;
foreach ($_SESSION['cartItems'] as $cartId => $cartItem){
  $cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
}

?>

<div>
 
<p class="float-end w-25 mt-4"><b> Total:</b> <?=$cartTotalSum?></p>
</div>
    <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) : ?>

  <div class="w-75 mx-auto mt-4 ">
  <table class="table  text-center">
  <thead>
    <tr>
      <th scope="col">Book</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Qty</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <img src="admin/<?=htmlentities($cartItem['img_url']) ?>"  alt="..." width="70" 
     height="70">
      </td>
      <th><?=$cartItem['title']?></th>
      <td><?=$cartItem['price']?></td>
      <td><?=$cartItem['quantity']?></td>
      <td>
      <form action="delete-cart-item.php" method="POST">
        <input type="hidden" name="cartId" value="<?=$cartId?>">
        <input type="submit" value="Delete" class="btn btn-primary">
      </form>
      <form action="update-cart-item.php" method="POST" class="update-cart-form mt-1" >
        <input type="hidden" name="cartId" value="<?=$cartId?>">
        <input type="number" style="width: 4em"  name="quantity" value="<?=$cartItem['quantity']?>" min="0">
      </form>
      </td>
    </tr>
  </tbody>
</table>
</div>
<?php endforeach; ?>

<div class="wrapper-checkout text-center">
  <h2>Handle payment</h2>
</div>
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
  <!-- Create Order Btn -->
    <input type="submit" class="btn btn-primary btn-form" name="createOrderBtn" value="Confirm Payment">
</form>


<script>
  $('.update-cart-form input[name="quantity"]').on('change', function(){
    $this.parent().submit();
  })
</script>
<?php 
include(LAYOUT_PATH . 'footer.php');
?>
