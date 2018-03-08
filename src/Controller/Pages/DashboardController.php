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
    public function __construct(\Example\Block\Pages\DashboardBlock $block)
    {
        $this->block = $block;
    }

    /**
     * home action
     */
    public function home() {

        $block = $this->block;
        require_once('./views/pages/dashboard.phtml');

    }
}