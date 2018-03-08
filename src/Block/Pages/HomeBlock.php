<?php

namespace Example\Block\Pages;

/**
 * Class HomeBlock
 * @package Example\Block\Pages
 */
class HomeBlock {

    /** @var string $title */
    private $title = 'Contact Us';

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}