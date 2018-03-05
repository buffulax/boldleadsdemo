<?php

namespace Example\Block\Pages;

/**
 * Class HomeBlock
 * @package Example\Block\Pages
 */
class HomeBlock {

    private $firstName = '';
    private $lastName = '';

    public function __construct()
    {
        $this->firstName = 'Jon';
        $this->lastName = 'Snow';
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }
}