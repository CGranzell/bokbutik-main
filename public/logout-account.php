<?php 
require('../src/app/functions.php');

// Förstör sessionen och loggar ut användaren och skickar till logga in igen
session_start();
$_SESSION = [];
session_destroy();
redirect("login-account", "logout");
?>