<?php
require('../../src/config.php');

$message = '';

if (array_key_exists('submitBtn', $_POST)) {

    $user_id = trim($_POST['id']);
    $user_data = [
        $first_name = trim($_POST['first_name']),
        $last_name = trim($_POST['last_name']),
        $email = trim($_POST['email']),
        $password = trim($_POST['password']),
        $phone = trim($_POST['phone']),
        $street = trim($_POST['street']),
        $postal_code = trim($_POST['postal_code']),
        $city = trim($_POST['city']),
        $country = trim($_POST['country']),
    ];

    $sql= $userDbHandler->updateUser($user_id, $user_data);

     if ($sql) {
          $message = 'User info has been updated ';
             echo json_encode($message);

       } else {
           $message = 'Something went wrong';
           echo json_encode($message);
        }

}
