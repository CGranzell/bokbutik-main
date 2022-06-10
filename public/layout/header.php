<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="<?=CSS_PATH . 'style.css'?>">


  <title>Header</title>
</head>

<body>

  <nav class="navbar-light" style="background-color: #e3f2fd;">
    <ul class="nav justify-content-center">
      
      <li class="nav-item">
        <a class="nav-link" href="./index.php">Home</a>
      </li>

      <li class='nav-item'>
            <a class='nav-link' href='./admin/index.php'>Admin</a>
          </li>


      
      <div class="login-nav">
        <!-- Om användaren är inloggad -->
        <?php
        if (isset($_SESSION['email'])) {
          $loggedInUserName = htmlentities($_SESSION['email']);
          $loggedinNav = "
          <li class='nav-item'>
            <a class='nav-link' href='./admin/index.php'>Admin</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='./admin/users.php'>Users</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='./my-account.php'>{$loggedInUserName}</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='./logout-account.php?logout'>Log out</a>
          </li>
          
          ";
        } else { //Om användaren inte är inloggad

          $loggedinNav = "
          <li class='nav-item'>
            <a class='nav-link' href='./register-account.php'>Register</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='./login-account.php'>Login</a>
          </li>
          ";
        }

        echo $loggedinNav;
        ?>

      </div>

    </ul>
  </nav>


