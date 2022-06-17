<?php
require('../../src/config.php');

$message = '';

if (array_key_exists('submitBtn', $_POST)) {
    $user_id = trim($_POST['id']);
    $first_name = trim($_POST['firstname']);
    $last_name = trim($_POST['lastname']);
    $phone = trim($_POST['phone']);
    $street = trim($_POST['street']);
    $postal_code = trim($_POST['postalcode']);
    $country = trim($_POST['country']);
    $city = trim($_POST['city']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($first_name || $last_name || $password || $street || $postal_code || $country || $city || $email || $password || $phone) {

        $sql = $dbconnect->prepare(' UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email, password=:password, phone=:phone, street=:street, postal_code=:postal_code, city=:city, country=:country WHERE id=:id ')->execute([
            'id' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'phone' => $phone,
            'street' => $street,
            'postal_code' => $postal_code,
            'city' => $city,
            'country' => $country

        ]);


        if ($sql) {
            $message = 'User info has been updated ';
            echo json_encode($message);
        } else {
            $message = 'Something went wrong';
            echo json_encode($message);
        }
    }
}

?>
