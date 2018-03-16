<?php

namespace Example\Utility;

/**
 * Class UserSession
 * @package Example\Utility
 */
class UserSession
{
    /** @var \Example\Model\Users\UsersGateway $usersGateway */
    private $usersGateway;

    /**
     * UserSession constructor.
     *
     * @param \Example\Model\Users\UsersGateway $usersGateway
     */
    public function __construct(
        \Example\Model\Users\UsersGateway $usersGateway
    ) {
        $this->usersGateway = $usersGateway;
    }

    /**
     * @param $isLoggedIn
     * @return $this
     */
    public function setIsLoggedIn($isLoggedIn)
    {
        $_SESSION['is_logged_in'] = $isLoggedIn;
        if (!$isLoggedIn) unset($_SESSION['customer_id']);
        return $this;
    }

    /**
     * @param $customerId
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        $_SESSION['customer_id'] = $customerId;
        return $this;
    }

    /**
     * @return integer|null
     */
    public function getCustomerId()
    {
        if (isset($_SESSION['customer_id']) && $_SESSION['customer_id']) {
            return $_SESSION['customer_id'];
        }

        return null;
    }

    /**
     * @return bool
     */
    public function getIsLoggedIn()
    {
        if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
            return $_SESSION['is_logged_in'];
        }

        return false;
    }

    /**
     * @return \Example\Model\Users\UsersModel|null
     */
    public function getUsersModel()
    {
        if ($this->getIsLoggedIn() && $this->getCustomerId()) {
            return $this->usersGateway->getUserById($this->getCustomerId());
        }

        return null;
    }
}