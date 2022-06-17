<?php

// Om sesion inte är satt
if(!isset($_SESSION['cartItems'])){
  $_SESSION['cartItems'] = [];
  }

// Om det finns något i varukorgen
$cartItemCount = count($_SESSION['cartItems']);
$cartTotalSum = 0;
foreach ($_SESSION['cartItems'] as $cartId => $cartItem){
  $cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <link rel="stylesheet" href="<?=CSS_PATH_ADMIN . 'style.css'?>">


  <title>Header</title>
</head>

<body>

  <nav class="navbar-light" style="background-color: #e3f2fd;">
    <ul class="nav justify-content-center">
      
      <li class="nav-item">
        <a class="nav-link" href="../index.php">Home</a>
      </li>

      <li class='nav-item'>
            <a class='nav-link' href='./index.php'>Admin</a>
          </li>


      
      <div class="login-nav">
        <!-- Om användaren är inloggad -->
        <?php
        if (isset($_SESSION['email'])) {
          $loggedInUserName = htmlentities($_SESSION['email']);
          $loggedinNav = "
          <li class='nav-item'>
            <a class='nav-link' href='./index.php'>Admin</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='./users.php'>Users</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='../my-account.php'>{$loggedInUserName}</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='../logout-account.php?logout'>Log out</a>
          </li>
          
          ";
        } else { //Om användaren inte är inloggad

          $loggedinNav = "
          <li class='nav-item'>
            <a class='nav-link' href='../register-account.php'>Register</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='../login-account.php'>Login</a>
          </li>
          ";
        }

        echo $loggedinNav;
        ?>
             <!-- Dropdown  -->
            
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    <b>Cart</b>
    <span><?=$cartItemCount?></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
  <div class="float-end">
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
     
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <img src="<?=htmlentities($cartItem['img_url']) ?>" alt="..." width="100" 
     height="100">
      </td>
      <th><?=$cartItem['title']?></th>
      <td><?=$cartItem['price']?></td>
      <td><?=$cartItem['quantity']?></td>
    </tr>
    
  </tbody>
</table>

<?php endforeach; ?>
<a href="../checkout-chris.php">Checkout</a>
  </ul>
</div>
        <!-- Dropdown slut -->



      </div>

    </ul>
  </nav>


