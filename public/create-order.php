<?php 

require('../src/config.php');

// debug($_POST);
// debug($_SESSION);

if(isset($_POST['createOrderBtn'])
  && !empty($_SESSION['cartItems'])) {


    //Tar bort mellanslag före och efter textsträng
    $firstname    = trim($_POST['first_name']);
    $lastname     = trim($_POST['last_name']);
    $email        = trim($_POST['email']);
    $password     = trim($_POST['password']);
    $phone        = trim($_POST['phone']);
    $street       = trim($_POST['street']);
    $postalcode   = trim($_POST['postal_code']);
    $city         = trim($_POST['city']);
    $country      = trim($_POST['country']);
    $cartTotalSum = $_POST['cartTotalSum'];

    $sql = "
      SELECT * FROM users
      WHERE email = :email;
    ";

    $stmt = $dbconnect->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();
    $userId = isset($user['id']) ? $user['id'] : null;
    
    // OM user inte finns
    if(empty($user)){
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

    $stmt = $dbconnect->prepare($sql);
    $stmt->bindParam(':first_name', $firstname);
    $stmt->bindParam(':last_name', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password',$password);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':postal_code', $postalcode);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':country', $country);
    $stmt->execute();
    $userId = $dbconnect->lastInsertId();
    }

    debug($userId);

// Skapa order
 // OM user inte finns
 
  $sql = "
  INSERT INTO orders 
  (
   user_id, 
   total_price,
   billing_full_name,
   billing_street,
   billing_postal_code,
   billing_city,
   billing_country
  )
  VALUES 
  (
   :user_id,
   :total_price,
   :billing_full_name,
   :billing_street,
   :billing_postal_code,
   :billing_city,
   :billing_country
  )
";

$stmt = $dbconnect->prepare($sql);
$stmt->bindValue(':user_id', $userId);
$stmt->bindValue(':total_price', $cartTotalSum);
$stmt->bindValue(':billing_full_name', $firstname . " " . $lastname);
$stmt->bindValue(':billing_street', $street);
$stmt->bindValue(':billing_postal_code', $postalcode);
$stmt->bindValue(':billing_city', $city);
$stmt->bindValue(':billing_country', $country);
$stmt->execute();
$orderId = $dbconnect->lastInsertId();


foreach($_SESSION['cartItems'] as  $item) {
  $sql = "
  INSERT INTO order_items 
  (
  order_id,
  product_id,
  product_title,
  quantity,
  unit_price
  )
  VALUES 
  (
  :order_id,
  :product_id,
  :product_title,
  :quantity,
  :unit_price
  )
";

$stmt = $dbconnect->prepare($sql);
$stmt->bindValue(':order_id', $orderId);
$stmt->bindValue(':product_id', $item['id']);
$stmt->bindValue(':product_title', $item['title']);
$stmt->bindValue(':quantity', $item['quantity']);
$stmt->bindValue(':unit_price',$item['price']);
$stmt->execute();

}

  header('Location: order-confirmation.php');
  exit;




}

header('Location: checkout.php');
exit;



?>