<?php
require('../src/config.php');
include(LAYOUT_PATH . 'header-public.php');

// debug($_SESSION['cartItems']);

$cartItemCount = count($_SESSION['cartItems']);
$cartTotalSum = 0;
foreach ($_SESSION['cartItems'] as $cartId => $cartItem){
  $cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
}

?>
<div>
 
<p><b> Total:</b> <?=$cartTotalSum?></p>
</div>
    <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) : ?>

  
  <table class="table">
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
        <img src="admin/<?=htmlentities($cartItem['img_url']) ?>" class="card-img-top" alt="..." width="100" 
     height="100">
      </td>
      <th><?=$cartItem['title']?></th>
      <td><?=$cartItem['price']?></td>
      <td><?=$cartItem['quantity']?></td>
      <td>
      <form action="delete-cart-item-chris.php" method="POST">
        <input type="hidden" name="cartId" value="<?=$cartId?>">
        <input type="submit" value="Delete">
      </form>
      <form action="update-cart-item-chris.php" method="POST" class="update-cart-form">
        <input type="hidden" name="cartId" value="<?=$cartId?>">
        <input type="number" name="quantity" value="<?=$cartItem['quantity']?>" min="0">
      </form>
      </td>
    </tr>
    
  </tbody>
</table>
<?php endforeach; ?>


<h3>Handle payment</h3>
	<!-- Registrerings formulär -->
  <form method="POST" action="create-order-chris.php" class="form mx-auto">
    <input type="hidden" name="cartTotalSum" value="<?=$cartTotalSum?>">
		<!-- First Name -->
		<div class="mb-3">
    <label for="first-name" class="form-label">First Name</label>
    <!-- <?=$errorMessageFirstname  ?> -->
    <input type="text" class="form-control" id="first-name" name="first_name">
  </div>
		<!-- Last Name -->
		<div class="mb-3">
    <label for="last-name" class="form-label">Last Name</label>
    <!-- <?=$errorMessageLastname ?> -->
    <input type="text" class="form-control" id="last-name" name="last_name">
  </div>
	<!-- Email -->
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <!-- <?=$errorMessageEmail ?> -->
    <input type="email" class="form-control" name="email">
  </div>
	<!-- Password -->
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <!-- <?=$errorMessagePassword ?> -->
    <input type="password" class="form-control" id="password" name="password">
  </div>
  	
		<!-- Phone -->
		<div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <!-- <?=$errorMessagePhone ?> -->
    <input type="tel" class="form-control" id="phone" name="phone">
  </div>
		<!-- Street -->
		<div class="mb-3">
    <label for="street" class="form-label">Street</label>
    <!-- <?=$errorMessageStreet ?> -->
    <input type="text" class="form-control" id="street" name="street">
  </div>
		<!-- Postal Code -->
		<div class="mb-3">
    <label for="postal_code" class="form-label">Postal Code</label>
    <!-- <?=$errorMessagePostalcode ?> -->
    <input type="number" class="form-control" id="postal-code" name="postal_code">
  </div>
		<!-- City -->
		<div class="mb-3">
    <label for="city" class="form-label">City</label>
    <!-- <?=$errorMessageCity ?> -->
    <input type="text" class="form-control" id="city" name="city">
  </div>
		<!-- Country -->
		<div class="mb-3">
    <label for="country" class="form-label">Country</label>
    <!-- <?=$errorMessageCountry ?> -->
    <input type="text" class="form-control" id="counrty" name="country">
  </div>
  <!-- Create User Btn -->
  <input type="submit" class="btn btn-primary btn-form" name="createOrderBtn" value="Confirm Payment">
</form>

</div>

<script>
  $('.update-cart-form input[name="quantity"]').on('change', function(){
    $this.parent().submit();
  })
</script>
<?php 
include(LAYOUT_PATH . 'footer.php');
?>
