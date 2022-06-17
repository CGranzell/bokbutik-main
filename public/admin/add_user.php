<?php
require('../../src/config.php');
$message = '';
$error = '';

if (array_key_exists('submitBtn', $_POST)) {

    $first_name = trim($_POST['firstname']);
    $last_name = trim($_POST['lastname']);
    $phone = trim($_POST['phone']);
    $street = trim($_POST['street']);
    $postal_code = trim($_POST['postalcode']);
    $country = trim($_POST['country']);
    $city = trim($_POST['city']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($first_name && $last_name && $password && $street && $postal_code && $country && $city && $email && $password && $phone) {

        $sql = "INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country )
    VALUES (:first_name, :last_name, :email, :password, :phone, :street, :postal_code, :city, :country );
     ";

        $stmt = $dbconnect->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':country', $country);
        $stmt->execute();

        if($sql) {
            $message = 'One user has been created';
            echo json_encode($message);
        }

    } else {
        $error = 'All fields must be filled';
        echo json_encode($error);
    }
}
