<?php

namespace Example\Controller\Pages;

use \Example\Controller\Framework\AbstractPageController;
use \Example\Block\Pages\HomeBlock;

/**
 * Class HomeController
 * @package Example\Controller\Pages
 */
class HomeController extends AbstractPageController {

    /** @var \Example\Block\Pages\HomeBlock $block */
    private $block;

    /**
     * HomeController constructor.
     * @param HomeBlock $block
     */
    public function __construct(\Example\Block\Pages\HomeBlock $block)
    {
        $this->block = $block;
    }

    /**
     * home action
     */
    public function home() {

    	$block = $this->block;
    	require_once('./views/pages/home.phtml');

	}
}