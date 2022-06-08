<?php

// Hämtar alla users
function fetchAllUsers() {
  global $dbconnect;
  $sql = "SELECT * FROM users";
  $statement = $dbconnect->query($sql);
  return $statement->fetchAll();
}

// Hämta en user 
function fetchOneUser($id){
  global $dbconnect;
$sql = "
SELECT * FROM users 
WHERE id = :id
";
$statement = $dbconnect->prepare($sql);
$statement->bindParam(':id', $id);
$statement->execute();
return $statement->fetch();

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
// Hämta användare efter email OCH password
function fetchUserByEmailAndPassword($email, $password){
   global $dbconnect;
  // Hämtar användare som har rätt email och password
  $sql = '
    SELECT * FROM users
    WHERE email = :email AND password = :password
  ';

  $statement = $dbconnect->prepare($sql);
  $statement->bindParam(':email', $email);
  $statement->bindParam(':password', $password);
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

// Uppdaterar en användare
function updateUser($id, $array) {
  global $dbconnect;
  $sql = "
    UPDATE users 
    SET 
      first_name  = :first_name,
      last_name   = :last_name,
      email       = :email,
      password    = :password,
      phone       = :phone,
      street      = :street,
      postal_code = :postal_code,
      city        = :city,
      country     = :country
    
    WHERE id = :id
    ";
    $statement = $dbconnect->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':first_name', $array[0]);
    $statement->bindParam(':last_name', $array[1]);
    $statement->bindParam(':email', $array[2]);
    $statement->bindParam(':password', $array[3]);
    $statement->bindParam(':phone', $array[4]);
    $statement->bindParam(':street',$array[5]);
    $statement->bindParam(':postal_code', $array[6]);
    $statement->bindParam(':city', $array[7]);
    $statement->bindParam(':country', $array[8]);
    $statement->execute();
}