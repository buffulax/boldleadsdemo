<?php

function call($controller, $action) {

    //echo $controller . ' - ' . $action;

    // create a new instance of the needed controller
    switch($controller) {
        case 'pages':
            $controller = new \Example\Controller\Pages\HomeController();
            break;
        case 'leads':
            $controller = new \Example\Controller\Api\LeadsController();
            break;
        case 'dashboard':
            $controller = new \Example\Controller\Pages\DashboardController();
            break;
        case 'lead':
            $controller = new \Example\Controller\Pages\LeadController();
            break;

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