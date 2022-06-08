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

// Felmeddelande om password inte matchar confirmed password
function noMatchPassword($message){
  $message = '
  <div class="alert alert-danger message mx-auto">
      The password do not match!
  </div>
  ';
  return $message;
}


// felmeddelande om textfält är tomt 
function errorRequiredField($name){
   $name = "
  <div class='alert alert-danger message mx-auto'>
     {$name} is required
  </div>
";
  return $name;
}




