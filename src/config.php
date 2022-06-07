<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session 
session_start();

define('ROOT_PATH', '..' . __DIR__ . '/'); // path to 'bokbutik-main/'
define('SRC_PATH',  __DIR__ . '/'); // path to 'bokbutik-main/src/'
define('CSS_PATH', '../public/css/');          // path to "css"-folder

 //print(ROOT_PATH);

// Include functions and classes

// Examine the dynamic paths
// print_r(ROOT_PATH);
// print_r(SRC_PATH);
// print_r(CSS_PATH . 'style.css');


// path till dbconnect
require(SRC_PATH . '/dbconnect.php');
// path to css
// include(CSS_PATH . 'style.css');
