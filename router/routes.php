<?php

function call($controller, $action) {

    //$container = new \DI\Container();

    $builder = new \DI\ContainerBuilder();
    $builder->addDefinitions([
        'PDO' => new \PDO('mysql:host=localhost;dbname=webdata', 'webuser', 'password', [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION])
    ]);

    try {
        $container = $builder->build();
    } catch (\Exception $exception) {
        $container = new \DI\Container();
    }

    try {
        // Get the instance of the needed controller from the DI Container
        switch ($controller) {
            case 'pages':
                $controller = $container->get('\Example\Controller\Pages\HomeController');
                break;
            case 'leads':
                $controller = $container->get('Example\Controller\Api\LeadsController');
                break;
            case 'dashboard':
                $controller = $container->get('\Example\Controller\Pages\DashboardController');
                break;
            case 'lead':
                $controller = $container->get('\Example\Controller\Pages\LeadController');
                break;

        }
    } catch (\Exception $exception) {
        $block = new \Example\Block\Pages\HomeBlock();
        $controller = new \Example\Controller\Pages\HomeController($block);
        $action = 'error';
    }

    // call the action
    $controller->{ $action }();
}

// just a list of the controllers we have and their actions
// we consider those "allowed" values
$controllers =
    [
        'pages' => ['home', 'error'],
        'dashboard' => ['home', 'error'],
        'lead' => ['home', 'error'],
        'leads' => ['get', 'create']
    ];

// check that the requested controller and action are both allowed
// if someone tries to access something else he will be redirected to the error action of the pages controller
if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('pages', 'error');
    }
} else {
    call('pages', 'error');
}