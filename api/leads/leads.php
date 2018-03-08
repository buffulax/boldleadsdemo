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

require_once('../../router/routes.php');