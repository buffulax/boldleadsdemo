<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/6/18
 * Time: 4:02 PM
 */

namespace Example\Model\Leads;

use \Example\Model\Framework\ToArray;

/**
 * Class LeadsModel
 * @package Example\Model\Leads
 */
class LeadsModel implements ToArray
{
    const ID = 'id';                            private $id;
    const SESSION_ID = 'session_id';            private $session_id;
    const EMAIL = 'email';                      private $email;
    const FIRSTNAME = 'firstname';              private $firstname;
    const LASTNAME = 'lastname';                private $lastname;
    const PHONE = 'phone';                      private $phone;
    const ADDRESS = 'address';                  private $address;
    const SQUARE_FOOTAGE = 'square_footage';    private $square_footage;
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
    public function getSessionId()
    {
        return $this->session_id;
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
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getSquareFootage()
    {
        return $this->square_footage;
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
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
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
     * @param $session_id
     * @return $this
     */
    public function setSessionId($session_id)
    {
        $this->session_id = $session_id;
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
     * @param $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param $square_footage
     * @return $this
     */
    public function setSquareFootage($square_footage)
    {
        $this->square_footage = $square_footage;
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
     * @param $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
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
     * @return array
     */
    public function toArray()
    {
        return [
            self::ID => $this->getId(),
            self::SESSION_ID => $this->getSessionId(),
            self::EMAIL => $this->getEmail(),
            self::FIRSTNAME => $this->getFirstname(),
            self::LASTNAME => $this->getLastname(),
            self::PHONE => $this->getPhone(),
            self::ADDRESS => $this->getAddress(),
            self::SQUARE_FOOTAGE => $this->getSquareFootage(),
            self::STATUS => $this->getStatus(),
            self::UPDATED_AT => $this->getUpdatedAt(),
            self::CREATED_AT => $this->getCreatedAt()
        ];
    }

}