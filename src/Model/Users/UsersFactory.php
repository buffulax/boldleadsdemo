<?php

namespace Example\Model\Users;

use \Example\Model\Framework\Factory;

/**
 * Class UsersFactory
 * @package Example\Model\Users
 */
class UsersFactory implements Factory
{
    /**
     * @return UsersModel
     */
    public function create()
    {
        return new \Example\Model\Users\UsersModel();
    }
}