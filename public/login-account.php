<?php
require('../src/config.php');
include(LAYOUT_PATH . 'header.php');



// Sätter meddelande till tom
$message = "";

if(isset($_GET['mustLogin'])) {
  $message  = mustLogin($message);
}
if(isset($_GET['logout'])) {
  $message = isLoggedOut($message);
}
if(isset($_GET['registerSuccess'])){
  $message  = registerSucces($message);
}

// Logga in
if(isset($_POST['loginBtn'])) {
  //Tar bort mellanslag före och efter textsträng
  $email    = trim($_POST['email']);
  $password = trim($_POST['password']);

  $user = $userDbHandler->fetchUserByEmail($email);
  // Om användaren finns och stämmer med krypterade lösenord
  if($user && password_verify($password, $user['password'])){
      $_SESSION['email'] = $user['email'];
      $_SESSION['id'] = $user['id'];
      redirect("my-account", "");
  } else { //OM anändaren inte finns
    $message  = userNotExists($message);
  }
}
?>

<div class="wrapper-login mx-auto">

 <h2>Welcome</h2>
 
 <?= $message  ?>

      <!-- Inloggningsformulär -->
      <form method="POST" action="" class="form mx-auto"> 
      <!-- Email -->
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email">
      </div>
      <!-- Password -->
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <!-- Login Btn -->
      <input type="submit" class="btn btn-primary btn-form" name="loginBtn" value="Login">
    </form>
</div>
<hr>
<div class="wrapper-login-new-user mx-auto">
    <h3>New User?</h3>
    <a href="register-account.php" class="btn btn-primary ">Register here</a>
</div>
<?php 
include(LAYOUT_PATH . 'footer.php');
?>
