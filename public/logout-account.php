<?php 
// Förstör sessionen och loggar ut användaren och skickar till logga in igen
session_start();
$_SESSION = [];
session_destroy();
header('Location: login-account.php?logout');
exit;
?>