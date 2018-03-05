<?php

namespace Example\Block\Pages;

/**
 * Class HomeBlock
 * @package Example\Block\Pages
 */
class HomeBlock {

    private $title = 'Contact Us';

    public function __construct()
    {

    }

    public function getTitle()
    {
        return $this->title;
    }
}