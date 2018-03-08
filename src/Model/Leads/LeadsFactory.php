<?php

namespace Example\Model\Leads;

use \Example\Model\Framework\Factory;

/**
 * Class LeadsFactory
 * @package Example\Model\Leads
 */
class LeadsFactory implements Factory
{
    /**
     * @return LeadsModel
     */
    public function create()
    {
        return new \Example\Model\Leads\LeadsModel();
    }
}