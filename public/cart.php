<?php
require('../src/config.php');
 include(LAYOUT_PATH . 'header-public.php');

$cartItemCount = count($_SESSION['cartItems']);
$cartTotalSum = 0;
foreach ($_SESSION['cartItems'] as $cartId => $cartItem){
  $cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
}

?>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Cart
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) : ?>


  <table class="table">
  <thead>
    <tr>
      <p><?=$cartItemCount?></p>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Qty</th>
      <th scope="col">Img</th>
      <th scope="col">Total Sum</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th><?=$cartItem['title']?></th>
      <td><?=$cartItem['price']?></td>
      <td><?=$cartItem['quantity']?></td>
      <td>
        <img src="admin/<?=htmlentities($cartItem['img_url']) ?>" class="card-img-top" alt="...">
      </td>
      <td>
      <?=$cartTotalSum?>
      </td>
    </tr>

  </tbody>
</table>

<?php endforeach; ?>
  </ul>
</div>

<?php
include(LAYOUT_PATH . 'footer.php');
?>
