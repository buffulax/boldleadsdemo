<?php

namespace Example\Controller\Pages;

use \Example\Controller\Framework\AbstractPageController;
use \Example\Block\Pages\DashboardBlock;

/**
 * Class DashboardController
 * @package Example\Controller\Pages
 */
class DashboardController extends AbstractPageController {

    /** @var \Example\Block\Pages\DashboardBlock $block */
    private $block;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->block = new DashboardBlock();
    }

    /**
     * home action
     */
    public function home() {

        $block = $this->block;
        require_once('./views/pages/dashboard.phtml');

    }
}