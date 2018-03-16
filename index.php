<?php
session_start();
ob_start();

require_once('./vendor/autoload.php');

    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controller = $_GET['controller'];
        $action     = $_GET['action'];
    } else {
        $controller = 'pages';
        $action     = 'home';
    }

    /** PHP-DI Dependency Injection Manager */
    $builder = new \DI\ContainerBuilder();
    $builder->addDefinitions([
        'PDO' => \Example\Database\Connection::getInstance()
    ]);

    /** @var \DI\Container $container */
    try {
        $container = $builder->build();
    } catch (\Exception $exception) {
        $container = new \DI\Container();
    }

    require_once('./views/layout.phtml');
    $output = ob_get_contents();
    ob_clean();
    echo $output;