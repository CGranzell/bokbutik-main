<?php
// require('../src/config.php');

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

// Hämtar alla users
function fetchAllUsers() {
  global $dbconnect;
  $sql = "SELECT * FROM users";
  $statement = $dbconnect->query($sql);
  return $statement->fetchAll();
}

// Tar bort user 
function deleteUser(){
  global $dbconnect;
  $sql = "
  DELETE FROM users 
  WHERE id = :id;
  ";
  $statement = $dbconnect->prepare($sql);
  $statement->bindParam(':id', $_POST['userID']);
  $statement->execute();
}