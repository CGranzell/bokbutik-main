<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session
session_start();

define('ROOT_PATH', '..' . __DIR__ . '/'); // path to 'bokbutik-main/'
define('SRC_PATH',  __DIR__ . '/'); // path to 'bokbutik-main/src/'
define('CSS_PATH', '../public/css/');          // path to "css"-folder
define('LAYOUT_PATH', '../public/layout/');   // path to "layout"-folder

// Examine the dynamic paths
// print_r(ROOT_PATH);
// print_r(SRC_PATH);
// print_r(__DIR__);
// print_r(SRC_PATH . 'dbconnect.php');
// print_r('CSS_PATH', '../public/css/');


// path till dbconnect
require(SRC_PATH . '/dbconnect.php');
// path till header
// include(LAYOUT_PATH . '/header.php');
// path till footer
// include(LAYOUT_PATH . '/footer.php');