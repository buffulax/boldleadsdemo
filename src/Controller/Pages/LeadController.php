<?php

namespace Example\Controller\Pages;

use \Example\Controller\Framework\AbstractPageController;
use \Example\Block\Pages\LeadBlock;

/**
 * Class LeadController
 * @package Example\Controller\Pages
 */
class LeadController extends AbstractPageController {

    /** @var \Example\Block\Pages\LeadBlock $block */
    private $block;

    /**
     * LeadController constructor.
     *
     * @param LeadBlock $block
     */
    public function __construct(\Example\Block\Pages\LeadBlock $block)
    {
        $this->block = $block; //new LeadBlock();
    }

    /**
     * home action
     */
    public function home() {

        $block = $this->block;
        require_once('./views/pages/lead.phtml');

    }
}