<?php

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
// felmeddelande om email är upptagen
function emailAlreadyTaken($message){
  $message = '
  <div class="alert alert-danger message mx-auto">
      Email Already taken
  </div>
  ';
  return $message;
}
// meddelande om uppdatering lyckades
function uppdateSucces($message){
  $message = '
  <div class="alert alert-success message mx-auto">
      Succes! The post was updated
  </div>;
';
  return $message;
}

// felmeddelande om querystring har värdet invalidUser
function invalidUser($message){
  $message = '
  <div class="alert alert-danger message mx-auto">
      Trying to updated invalid User! Please try again
  </div>;
  ';
  return $message;
}
// felmeddelande om att användaren måste logga in , tex om man försöker komma åt my-account via url utan att ha loggat in.
function mustLogin($message){
  $message  = '
<div class="alert alert-danger message mx-auto">
    You must login !
</div>
';
  return $message;
}
// Meddelande om utloggning lyckades
function isLoggedOut($message){
  $message  = '
  <div class="alert alert-success message mx-auto">
      You are now loged out
  </div>
  ';
  return $message;
}
// Om användaren lyckades registrera 
function registerSucces($message){
  $message  = '
  <div class="alert alert-success message mx-auto">
      You succefully registered a new account! Please login
  </div>
';
  return $message;
}
//OM anändaren inte finns
function userNotExists($message){
  $message  = '
    <div class="alert alert-danger message mx-auto">
       Error! Wrong login info, please try again
    </div>
  ';
  return $message;
}

