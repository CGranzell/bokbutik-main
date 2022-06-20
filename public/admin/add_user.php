<?php
require('../../src/config.php');
$message = '';
$error = '';

if (array_key_exists('submitBtn', $_POST)) {

    $user_data = [
    $first_name = trim($_POST['firstname']),
    $last_name = trim($_POST['lastname']),
    $email = trim($_POST['email']),
    $password = trim($_POST['password']),
    $phone = trim($_POST['phone']),
    $street = trim($_POST['street']),
    $postal_code = trim($_POST['postalcode']),
    $city = trim($_POST['city']),
    $country = trim($_POST['country']),
 ];

 // Check if user exist
 $user_exist = $userDbHandler->fetchUserByEmail($_POST['email']);

 if($user_exist){
    $message = [500, 'This email already exist.'];
    echo json_encode($message);
 } else {
    $sql = $userDbHandler->addUser($user_data);
    if($sql) {
        $message = 'One user has been created';
        echo json_encode($message);
    } else {
        $message = 'Something wrong --create user';
        echo json_encode($message);
    }
 }



     }
