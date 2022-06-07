<?php


// Lösenordsskyddad, om SESSION inte är satt från login kan användaren inte komma åt sidan
function checkLoginSession(){
if(!isset($_SESSION['email'])) {
  header('Location: login-account.php?mustLogin');
  exit;
}
}