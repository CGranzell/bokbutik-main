<?php
class UserDbHandler
{

  public function __construct($dbconnect)
  {
    $this->dbconnect = $dbconnect;
  }


  // --------- Användare -------
  // Hämtar alla användare
  public function fetchAllUsers()
  {

    $sql = "SELECT * FROM users";
    $statement = $this->dbconnect->query($sql);
    return $statement->fetchAll();
  }
  // Hämta en användare
  public function fetchOneUser($id)
  {

    $sql = "
  SELECT * FROM users
  WHERE id = :id
  ";
    $statement = $this->dbconnect->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();
    return $statement->fetch();
  }

  // Tar bort användare
  public function deleteUser($id)
  {

    $sql = "
  DELETE FROM users
  WHERE id = :id;
  ";
    $statement = $this->dbconnect->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();
  }

  // Hämta användare efter email
  public function fetchUserByEmail($email)
  {

    $sql = '
  SELECT * FROM users
  WHERE email = :email
';
    $statement = $this->dbconnect->prepare($sql);
    $statement->bindParam(':email', $email);
    $statement->execute();
    $query =  $statement->fetch();
  return $query;
  }


  // Skapa en användare
  public function addUser($array)
  {

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
    $statement->bindParam(':password', $encryptedPassword);
    $statement->bindParam(':phone', $array[4]);
    $statement->bindParam(':street', $array[5]);
    $statement->bindParam(':postal_code', $array[6]);
    $statement->bindParam(':city', $array[7]);
    $statement->bindParam(':country', $array[8]);
    $query = $statement->execute();
    return $query;
  }

  // Uppdaterar en användare
  public function updateUser($id, $array)
  {

    $sql = "
    UPDATE users
    SET
      first_name=:first_name,
      last_name=:last_name,
      email=:email,
      password=:password,
      phone=:phone,
      street=:street,
      postal_code=:postal_code,
      city=:city,
      country=:country

    WHERE id=:id
    ";
    $encryptedPassword = password_hash($array[3], PASSWORD_BCRYPT);
    $statement = $this->dbconnect->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':first_name', $array[0]);
    $statement->bindParam(':last_name', $array[1]);
    $statement->bindParam(':email', $array[2]);
    $statement->bindParam(':password', $encryptedPassword);
    $statement->bindParam(':phone', $array[4]);
    $statement->bindParam(':street', $array[5]);
    $statement->bindParam(':postal_code', $array[6]);
    $statement->bindParam(':city', $array[7]);
    $statement->bindParam(':country', $array[8]);
    $query = $statement->execute();

    return $query;
  }

  // --------- Produkter -------

  // Hämtar alla products
  public function fetchAllProducts()
  {

    $sql = "SELECT * FROM products";
    $statement = $this->dbconnect->query($sql);
    return $statement->fetchAll();
  }

  // Hämta en product
  public function fetchOneProduct($id)
  {

    $sql = "
  SELECT * FROM products
  WHERE id = :id
  ";
    $statement = $this->dbconnect->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->execute();
    return $statement->fetch();
  }

  // Skapa en produkt
  public function addProduct($array)
  {

    $sql = "
  INSERT INTO products
   (
    title,
    description,
    price,
    stock,
    img_url
   )
   VALUES
   (
    :title,
    :description,
    :price,
    :stock,
    :img_url
   )
  ";

    $statement = $this->dbconnect->prepare($sql);
    $statement->bindParam(':title', $array[0]);
    $statement->bindParam(':description', $array[1]);
    $statement->bindParam(':price', $array[2]);
    $statement->bindParam(':stock', $array[3]);
    $statement->bindParam(':img_url', $array[4]);
    $statement->execute();
  }

  // Tar bort produkt
  public function deleteProduct()
  {

    $sql = "
    DELETE FROM products
    WHERE id = :id;
    ";
    $statement = $this->dbconnect->prepare($sql);
    $statement->bindParam(':id', $_POST['productId']);
    $statement->execute();
  }



  // Uppdaterar en product
  public function updateProduct($id, $array)
  {

    $sql = "
  UPDATE products
  SET
    title       = :title,
    description = :description,
    price       = :price,
    stock       = :stock,
    img_url     = :img_url

    WHERE id    = :id
    ";

    $statement = $this->dbconnect->prepare($sql);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':title', $array[0]);
    $statement->bindParam(':description', $array[1]);
    $statement->bindParam(':price', $array[2]);
    $statement->bindParam(':stock', $array[3]);
    $statement->bindParam(':img_url', $array[4]);
    $statement->execute();
  }

  // Sök product
  public function searchProduct($product){
    $sql = $this->dbconnect->prepare('SELECT * FROM products WHERE title LIKE :keyword OR description LIKE :keyword ORDER BY title');
    $sql->bindValue(':keyword', '%' . $product . '%', PDO::PARAM_STR);
    $sql->execute();
    $query = $sql->fetchAll();
    return $query;
  }


//---------------- Orders ----------------

// Skapa en order
public function addOrder($userId, $array) {

  $sql = "
  INSERT INTO orders
  (
   user_id,
   total_price,
   billing_full_name,
   billing_street,
   billing_postal_code,
   billing_city,
   billing_country
  )
  VALUES
  (
   :user_id,
   :total_price,
   :billing_full_name,
   :billing_street,
   :billing_postal_code,
   :billing_city,
   :billing_country
  )
";
$stmt = $this->dbconnect->prepare($sql);
$stmt->bindValue(':user_id', $userId);
$stmt->bindValue(':total_price', $array[9]);
$stmt->bindValue(':billing_full_name', $array[0] . " " . $array[1]);
$stmt->bindValue(':billing_street', $array[5]);
$stmt->bindValue(':billing_postal_code', $array[6]);
$stmt->bindValue(':billing_city', $array[7]);
$stmt->bindValue(':billing_country', $array[8]);
$stmt->execute();
}

// Skapa en order item
public function addOrderItem ($orderId, $array) {

  foreach($array as  $item) {
  $sql = "
  INSERT INTO order_items
  (
  order_id,
  product_id,
  product_title,
  quantity,
  unit_price
  )
  VALUES
  (
  :order_id,
  :product_id,
  :product_title,
  :quantity,
  :unit_price
  )
";

$stmt = $this->dbconnect->prepare($sql);
$stmt->bindValue(':order_id', $orderId);
$stmt->bindValue(':product_id', $item['id']);
$stmt->bindValue(':product_title', $item['title']);
$stmt->bindValue(':quantity', $item['quantity']);
$stmt->bindValue(':unit_price',$item['price']);
$stmt->execute();
}
}

}


