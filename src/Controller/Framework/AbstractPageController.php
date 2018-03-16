<?php

namespace Example\Controller\Framework;

/**
 * @class AbstractPageController
 */
abstract class AbstractPageController {

    /** @var bool $is_error */
    protected $is_error = false;

    /** @var string $error_message */
    protected $error_message = '';

    /**
     * @function error
     */
	public function error() {
		require_once('./views/pages/error.phtml');
	}

}