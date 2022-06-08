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

// Hämta användare efter email
function fetchUserByEmail($email){
   global $dbconnect;
   $sql = '
   SELECT * FROM users
   WHERE email = :email
 ';
 $statement = $dbconnect->prepare($sql);
 $statement->bindParam(':email', $email);
 $statement->execute();
 return $statement->fetch();
}

// Skapa en användare
function addUser($array) {
  global $dbconnect;
  $sql = "
  INSERT INTO users 
   (
    first_name, 
    last_name,
    email,
    password,
    phone,
    street,
    postal_code,
    city,
    country
   )
   VALUES 
   (
    :first_name,
    :last_name,
    :email,
    :password,
    :phone,
    :street,
    :postal_code,
    :city,
    :country
   )
  ";
  $statement = $dbconnect->prepare($sql);
  $statement->bindParam(':first_name', $array[0]);
  $statement->bindParam(':last_name', $array[1]);
  $statement->bindParam(':email', $array[2]);
  $statement->bindParam(':password', $array[3]);
  $statement->bindParam(':phone', $array[4]);
  $statement->bindParam(':street', $array[5]);
  $statement->bindParam(':postal_code', $array[6]);
  $statement->bindParam(':city', $array[7]);
  $statement->bindParam(':country', $array[8]);
  $statement->execute();
}

