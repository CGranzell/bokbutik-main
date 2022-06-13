<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session 
session_start();

define('ROOT_PATH', '..' . __DIR__ . '/'); // path to 'bokbutik-main/'
define('SRC_PATH',  __DIR__ . '/'); // path to 'bokbutik-main/src/'
define('CSS_PATH', '../public/css/');          // path to "css"-folder
define('CSS_PATH_ADMIN', '../../public/css/');          // path to "css"-folder
define('LAYOUT_PATH', '../public/layout/');          // path to "layout"-folder
define('LAYOUT_PATH_ADMIN', '../../public/layout/');          // path to "layout"-folder
define('IMG_PATH', '../../public/');          // path to "img"-folder

 //print(ROOT_PATH);

// Include functions and classes

// Examine the dynamic paths
// print_r(ROOT_PATH);
// print_r(SRC_PATH);
// print_r(CSS_PATH . 'style.css');
// print_r(IMG_PATH . 'img/');


// path till dbconnect
require(SRC_PATH . '/dbconnect.php');
// path till common_functions
require(SRC_PATH . 'app/common_functions.php');
// path till messages_functions
require(SRC_PATH . 'app/messages_functions.php');
// path till messages_functions
require(SRC_PATH . 'app/user_functions.php');
// path till classes
require(SRC_PATH . 'app/classes.php');
$userDbHandler = new UserDbHandler($dbconnect);

