<?php


class UserDbHandler {

public function __construct($dbconnect)
{
  $this->dbconnect = $dbconnect;
}

// Hämtar alla users
public function fetchAllUsers() {
 
  $sql = "SELECT * FROM users";
  $statement = $this->dbconnect->query($sql);
  return $statement->fetchAll();
}

// Hämta en user 
public function fetchOneUser($id){
 
$sql = "
SELECT * FROM users 
WHERE id = :id
";
$statement = $this->dbconnect->prepare($sql);
$statement->bindParam(':id', $id);
$statement->execute();
return $statement->fetch();

}



// Tar bort user 
public function deleteUser(){
 
  $sql = "
  DELETE FROM users 
  WHERE id = :id;
  ";
  $statement = $this->dbconnect->prepare($sql);
  $statement->bindParam(':id', $_POST['userID']);
  $statement->execute();
}

// Hämta användare efter email
public function fetchUserByEmail($email){
  
   $sql = '
   SELECT * FROM users
   WHERE email = :email
 ';
 $statement = $this->dbconnect->prepare($sql);
 $statement->bindParam(':email', $email);
 $statement->execute();
 return $statement->fetch();
}


// Skapa en användare
public function addUser($array) {
 
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
  $encryptedPassword = password_hash($array[3], PASSWORD_BCRYPT);
  $statement = $this->dbconnect->prepare($sql);
  $statement->bindParam(':first_name', $array[0]);
  $statement->bindParam(':last_name', $array[1]);
  $statement->bindParam(':email', $array[2]);
  $statement->bindParam(':password',$encryptedPassword);
  $statement->bindParam(':phone', $array[4]);
  $statement->bindParam(':street', $array[5]);
  $statement->bindParam(':postal_code', $array[6]);
  $statement->bindParam(':city', $array[7]);
  $statement->bindParam(':country', $array[8]);
  $statement->execute();
}

// Uppdaterar en användare
public function updateUser($id, $array) {
 
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
    
    $statement = $this->dbconnect->prepare($sql);
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

}