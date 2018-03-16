<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/5/18
 * Time: 10:58 AM
 */
namespace Example\Model\Users;

/**
 * Class UsersGateway
 * @package Example\Model\Users
 */
class UsersGateway
{
    /** @var \PDO $pdo */
    private $pdo;

    /** @var UsersFactory $usersFactory */
    private $usersFactory;

    /** @var \Example\Model\Framework\CollectionFactory $collectionFactory */
    private $collectionFactory;

    /**
     * UsersGateway constructor.
     *
     * @param UsersFactory $usersFactory
     * @param \Example\Model\Framework\CollectionFactory $collectionFactory
     * @param \PDO $pdo
     */
    public function __construct(
        \Example\Model\Users\UsersFactory $usersFactory,
        \Example\Model\Framework\CollectionFactory $collectionFactory,
        \PDO $pdo
    ) {
        $this->pdo = $pdo;
        $this->usersFactory = $usersFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param UsersModel $user
     * @return UsersModel
     */
    public function saveUser(\Example\Model\Users\UsersModel $user)
    {
        if ($user->getId()):

            return $this->updateUser(
                $user->getId(),
                $user->getEmail(),
                $user->getHash(),
                $user->getFirstname(),
                $user->getLastname()
            );

        else:

            return $this->insertUser(
                $user->getEmail(),
                $user->getHash(),
                $user->getFirstname(),
                $user->getLastname()
            );

        endif;
    }

    /**
     * @param $id
     * @param $email
     * @param $hash
     * @param $firstName
     * @param $lastName
     * @param int $role
     * @param int $status
     * @return UsersModel
     */
    private function updateUser($id, $email, $hash, $firstName, $lastName, $role = 1,  $status = 1)
    {
        $query = $this->pdo->prepare("UPDATE users SET email=:email, hash=:hash, firstname=:firstname, lastname=:lastname, role=:role, status=:status WHERE id = :id");

        $query->bindValue(":email", $email);
        $query->bindValue(":hash", $hash);
        $query->bindValue(":firstname", $firstName);
        $query->bindValue(":lastname", $lastName);
        $query->bindParam(":role", $role);
        $query->bindParam(":status", $status);

        $query->bindParam(":id", $id);

        $query->execute();

        return $this->getUserById($id);
    }

    /**
     * @param $email
     * @param $hash
     * @param $firstName
     * @param $lastName
     * @param int $role
     * @param int $status
     * @return UsersModel
     */
    private function insertUser ($email, $hash, $firstName, $lastName, $role = 1, $status = 1)
    {
        $query = $this->pdo->prepare("INSERT INTO users (email, hash, firstname, lastname, role, status) VALUES (:email, :hash, :firstname, :lastname, :role, :status)");

        // bind the placeholder names to specific script variables
        $query->bindParam(":email", $email);
        $query->bindParam(":hash", $hash);
        $query->bindParam(":firstname", $firstName);
        $query->bindParam(":lastname", $lastName);
        $query->bindParam(":role", $role);
        $query->bindParam(":status", $status);

        $query->execute();

        return $this->getUserById($this->pdo->lastInsertId());
    }

    /**
     * @param $email
     * @return \Example\Model\Framework\Collection
     */
    public function getUsersByEmail($email)
    {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");

        $query->bindParam(":email", $email);

        $query->execute();

        $results = $query->fetchAll(\PDO::FETCH_ASSOC);

        $collection = $this->setCollection($results);

        return $collection;
    }


    /**
     * @param int $id
     * @return UsersModel
     */
    public function getUserById($id = 1)
    {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");

        $query->bindParam(":id", $id);

        $query->execute();

        $result = $query->fetch(\PDO::FETCH_ASSOC);

        $user = $this->setUser($result);

        return $user;
    }

    /**
     * @return \Example\Model\Framework\Collection
     */
    public function getUsers()
    {
        $query = $this->pdo->prepare("SELECT * FROM users");

        $query->execute();

        $results = $query->fetchAll(\PDO::FETCH_ASSOC);

        $collection = $this->setCollection($results);

        return $collection;
    }

    /** *************************************** **/
    /**       PRIVATE HELPER FUNCTIONS          **/
    /** *************************************** **/

    /**
     * @param array $results
     * @return \Example\Model\Framework\Collection
     */
    private function setCollection(array $results)
    {
        $collection = $this->collectionFactory->create();//new \Example\Model\Framework\Collection();

        foreach ($results as $result):

            $user = $this->setUser($result);

            $collection->setObjectArray($user);

            $collection->next();

        endforeach;

        return $collection;

    }

    /**
     * @param array $result
     * @return UsersModel
     */
    private function setUser(array $result)
    {
        $user = $this->usersFactory->create();

        $user->setId($result['id'])
            ->setId($result['id'])
            ->setEmail($result['email'])
            ->setHash($result['hash'])
            ->setFirstname($result['firstname'])
            ->setLastname($result['lastname'])
            ->setRole($result['role'])
            ->setStatus($result['status'])
            ->setCreatedAt($result['created_at'])
            ->setUpdatedAt($result['updated_at']);

        return $user;
    }
}