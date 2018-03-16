<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/6/18
 * Time: 4:02 PM
 */

namespace Example\Model\Users;

use \Example\Model\Framework\ToArray;

/**
 * Class UsersModel
 * @package Example\Model\Users
 */
class UsersModel implements ToArray
{

    const ID = 'id';                            private $id;
    const EMAIL = 'email';                      private $email;
    const HASH = 'hash';                        private $hash;
    const FIRSTNAME = 'firstname';              private $firstname;
    const LASTNAME = 'lastname';                private $lastname;
    const ROLE = 'role';                        private $role;
    const STATUS = 'status';                    private $status;
    const UPDATED_AT = 'updated_at';            private $updated_at;
    const CREATED_AT = 'created_at';            private $created_at;


    /** *************************************** **/
    /**                 GETTERS                 **/
    /** *************************************** **/

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /** *************************************** **/
    /**                 SETTERS                 **/
    /** *************************************** **/

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param $hash
     * @return $this
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @param $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @param $lastname
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @param $role
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param $updated_at
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @param $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            self::ID => $this->getId(),
            self::EMAIL => $this->getEmail(),
            self::HASH => $this->getHash(),
            self::FIRSTNAME => $this->getFirstname(),
            self::LASTNAME => $this->getLastname(),
            self::ROLE => $this->getRole(),
            self::STATUS => $this->getStatus(),
            self::UPDATED_AT => $this->getUpdatedAt(),
            self::CREATED_AT => $this->getCreatedAt()
        ];
    }

}