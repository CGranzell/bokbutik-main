<?php

require('../src/config.php');
include('./layout/header.php');


// Sätter meddelande till tom
$message = "";

if(isset($_GET['mustLogin'])) {
  $message  = '
<div class="alert alert-danger message mx-auto">
    You must login !
</div>;
';
}

if(isset($_GET['logout'])) {
$message  = '
<div class="alert alert-success message mx-auto">
    You are now loged out
</div>;
';
}
// Om användaren lyckades registrera , skriv ut meddelande
if(isset($_GET['registerSuccess'])){
  $message  = '
  <div class="alert alert-success message mx-auto">
      Succes! You succefully registered a new account! Please login
  </div>;
';
}


echo "<pre>";
print_r($_POST);
echo "</pre>";

// Logga in
if(isset($_POST['loginBtn'])) {
  //Tar bort mellanslag före och efter textsträng
  $email    = trim($_POST['email']);
  $password = trim($_POST['password']);

  // Hämtar användare som har rätt email och password
  $sql = '
    SELECT * FROM users
    WHERE email = :email AND password = :password
  ';

  $statement = $dbconnect->prepare($sql);
  $statement->bindParam(':email', $email);
  $statement->bindParam(':password', $password);
  $statement->execute();
  $user = $statement->fetch();
  // Om användaren finns
  if($user){
      $_SESSION['email'] = $user['email'];
      $_SESSION['id'] = $user['id'];
      header('Location: my-account.php');
      exit;
  } else { //OM anändaren inte finns
    $message  = '
    <div class="alert alert-danger message mx-auto">
       Error! Wrong login info, please try again
    </div>;
  ';
  }

}

echo "<pre>";
print_r($user);
echo "</pre>";




?>



 <h1>Log in</h1>
 <?= $message  ?>

 <div>
 <a class="nav-link" href="./my-account.php">My Account</a>
 </div>
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

<footer id="footer" class="mt-auto  footer">


</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
