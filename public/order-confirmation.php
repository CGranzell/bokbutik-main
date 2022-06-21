<?php 
require('../src/config.php');
include(LAYOUT_PATH . 'header-public.php');

if(empty($_SESSION['cartItems'])) {
  redirectNoMessage("checkout");
}
$cartItems = $_SESSION['cartItems'];
unset($_SESSION['cartItems']);
// Om det finns något i varukorgen
$totalSum = 0;
foreach ($cartItems as $cartId => $cartItem){
  $totalSum += $cartItem['price'] * $cartItem['quantity'];
}



?>
<div class="text-center mt-4">

  <H3>Thank you for your order </H3>
</div>

<div class="w-75 mx-auto mt-4">
<?php foreach ($cartItems as $item) : ?>

  
<table class="table">
<thead>
  <tr>
    
    <th scope="col">Book</th>
    <th scope="col">Title</th>
    <th scope="col">Price</th>
    <th scope="col">Qty</th>
   
  </tr>
</thead>
<tbody>
  <tr>
    <td>
      <img src="admin/<?=htmlentities($item['img_url']) ?>" alt="..." width="100" 
   height="100">
    </td>
    <th><?=$item['title']?></th>
    <td><?=$item['quantity']?></td>
    <td><?=$item['price']?></td>
  </tr>
  
</tbody>
</table>

<?php endforeach; ?>
<p class="float-end"><b> Total:</b> <?=$totalSum?></p>
</div>

<?php 
include(LAYOUT_PATH . 'footer.php');
?>
