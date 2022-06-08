<?php

// Lösenordsskyddad, om SESSION inte är satt från login kan användaren inte komma åt sidan
function checkLoginSession(){
if(!isset($_SESSION['email'])) {
  header('Location: login-account.php?mustLogin');
  exit;
  
}
}

// Hanterar utskrift på sidan med valfri kod, Variablar ,Superglobals tex.
function debug($value) {
echo"<pre>";
print_r($value);
echo"</pre>";
}

// Hanterar redirect
function redirect($path, $urlMessage){
  header("Location: {$path}.php?{$urlMessage}");
  exit;
}





