<?php

namespace Example\Controller\Pages;

use \Example\Controller\Framework\AbstractPageController;

/**
 * Class LoginController
 * @package Example\Controller\Pages
 */
class LoginController extends AbstractPageController{
	
	public function home() {
    	require_once('./views/pages/login.phtml');
	}
}
?>