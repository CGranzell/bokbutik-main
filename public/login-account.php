<?php

require('../src/config.php');
include('./layout/header.php');

// Sätter meddelande till tomma
$succesMessage = "";
if(isset($_GET['registerSuccess'])){
  $succesMessage = '
  <div class="alert alert-success message mx-auto">
      Succes! You succefully registered a new account! Please login
  </div>;
';
}


?>


  

 <h1>Log in</h1>
 <?= $succesMessage ?>
	<!-- Inloggningsformulär -->
  <form class="form" class="mx-auto">
	
	
	<!-- Email -->
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control">
  </div>
	<!-- Password -->
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password">
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
