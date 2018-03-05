<?php

namespace Example\Controller\Framework;

/**
 * @class AbstractPageController
 */
abstract class AbstractPageController {

    protected $is_error = false;
    protected $error_message = '';

	public function error() {
		require_once('./views/pages/error.phtml');
	}

}