<?php 
require('../src/config.php');
include(LAYOUT_PATH . 'header-public.php');

// debug($_POST);

if(!empty($_POST['quantity'])) {
    $productId = (int) $_POST['productID'];
    $quantity = (int) $_POST['quantity'];

    $sql = "
      SELECT * from products
      WHERE id = :id;
    ";

    $stmt = $dbconnect->prepare($sql);
    $stmt->bindParam(':id', $productId);
    $stmt->execute();
    $product = $stmt->fetch();

};
// debug($product);

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
  
  // debug($_SESSION['cartItems']);

}

// Skickar tillbaka användaren till sidan man var på innan
header('Location:' . $_SERVER['HTTP_REFERER']);
exit;

?>











<?php 


include(LAYOUT_PATH . 'footer.php');


?>