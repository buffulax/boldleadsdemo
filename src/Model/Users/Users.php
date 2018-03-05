<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/5/18
 * Time: 10:58 AM
 */
namespace Example\Model\Users;

/**
 * Class Users
 * @package Example\Model\Users
 */
class Users
{
    /** @var \PDO $pdo */
    private $pdo;

    /**
     * Users constructor.
     */
    public function __construct()
    {
        $this->pdo = \Example\Database\Connection::getInstance();
    }

    /**
     * @function insertIntoUsers
     *
     * @param string $email
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     * @param int $status
     */
    public function insertIntoUsers ($email, $password, $firstName, $lastName, $status = 1)
    {
        $query = $this->pdo->prepare("INSERT INTO users (email, password, firstname, lastname, status) VALUES (:email, :password, :firstname, :lastname, :status)");

        // bind the placeholder names to specific script variables
        $status = 1;
        $query->bindParam(":email", $email);
        $query->bindParam(":password", $password);
        $query->bindParam(":firstname", $firstName);
        $query->bindParam(":lastname", $lastName);
        $query->bindParam(":status", $status);

        $query->execute();
    }

}