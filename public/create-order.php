<?php 
require('../src/config.php');

if(isset($_POST['createOrderBtn'])
  && !empty($_SESSION['cartItems'])) {
    // skapar och fyller array med user info
    $userInfo = [
    //Tar bort mellanslag före och efter textsträng
    $firstname    = trim($_POST['first_name']),
    $lastname     = trim($_POST['last_name']),
    $email        = trim($_POST['email']),
    $password     = trim($_POST['password']),
    $phone        = trim($_POST['phone']),
    $street       = trim($_POST['street']),
    $postalcode   = trim($_POST['postal_code']),
    $city         = trim($_POST['city']),
    $country      = trim($_POST['country']),
    $cartTotalSum = $_POST['cartTotalSum'],
    ];
     
    $user = $userDbHandler->fetchUserByEmail($email);
    $userId = isset($user['id']) ? $user['id'] : null;
    
    // OM user inte finns
    if(empty($user)){
      $userDbHandler->addUser($userInfo);
      $userId = $dbconnect->lastInsertId();
    }

    $userDbHandler->addOrder($userId,$userInfo);
    $orderId = $dbconnect->lastInsertId();

    $userDbHandler->addOrderItem($orderId,$_SESSION['cartItems']);
    redirectNoMessage("order-confirmation");
}
redirectNoMessage("checkout");
?>