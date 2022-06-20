<?php 
require('../src/config.php');
include(LAYOUT_PATH . 'header-public.php');

if(!empty($_POST['quantity'])) {
    $productId = (int) $_POST['productID'];
    $quantity = (int) $_POST['quantity'];
    $product = $userDbHandler->fetchOneProduct($_POST['productID']);
};

if($product) {
  // Koppla ihop arrayerna 
  $product = array_merge($product, ['quantity' => $quantity]);

  $cartItem = [
    $productId => $product
  ];
  // Om session inte finns, skapa ett item
  if(empty($_SESSION['cartItems'])){
    $_SESSION['cartItems'] = $cartItem;
    
  } else {
    // Om produkten existerar i varukorgen
    if(isset($_SESSION['cartItems'][$productId])){
      $_SESSION['cartItems'][$productId]['quantity'] += $quantity; 
    }else {

    }
    // Om session finns , lägg till item till listan av items
    $_SESSION['cartItems'] += $cartItem;
  }
}
// Skickar tillbaka användaren till sidan man var på innan
header('Location:' . $_SERVER['HTTP_REFERER']);
exit;
