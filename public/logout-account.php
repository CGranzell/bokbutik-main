<?php 

require('../src/app/user_functions.php');
require('../src/app/common_functions.php');



// Förstör sessionen och loggar ut användaren och skickar till logga in igen
session_start();
// $_SESSION = [];
// session_destroy();
unset($_SESSION["email"]);
unset($_SESSION["id"]);


// Om användaren har raderat sitt konto
if(isset($_GET['succesDelete'])){
  redirect("login-account", "succesDelete");
  // Om användaren har loggat ut
} else if (isset($_GET['logout'])){
  redirect("login-account", "logout");
}
?>