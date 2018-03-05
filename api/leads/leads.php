<?php

session_start();

require_once('../../vendor/autoload.php');

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
} else {
    $controller = 'leads';
    $action     = 'get';
}

require_once('../../routes.php');
//print_r($_SESSION);
//die();

//ob_start();
//$output = ob_get_contents();
//ob_clean();
//$output = session_id();
//echo $output;