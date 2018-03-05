<?php

session_start();

require_once('./vendor/autoload.php');

  if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
  } else {
    $controller = 'pages';
    $action     = 'home';
  }

  ob_start();
  require_once('./views/layout.phtml');
  $output = ob_get_contents();
  ob_clean();
  echo $output;
