<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/5/18
 * Time: 10:58 AM
 */
namespace Example\Model\Leads;

/**
 * Class Leads
 * @package Example\Model\Leads
 */
class Leads
{
    /** @var \PDO $pdo */
    private $pdo;

    /**
     * Leads constructor.
     */
    public function __construct()
    {
        $this->pdo = \Example\Database\Connection::getInstance();
    }

    /**
     * @function insertLead
     *
     * @param $session_id
     * @param $email
     * @param $firstName
     * @param $lastName
     * @param $phone
     * @param $address
     * @param $square_footage
     * @param int $status
     */
    public function insertLead ($session_id, $email, $firstName, $lastName, $phone, $address, $square_footage, $status = 1)
    {
        $query = $this->pdo->prepare("INSERT INTO leads (session_id, email, firstname, lastname, phone, address, square_footage, status) VALUES (:session_id, :email, :firstname, :lastname, :phone, :address, :square_footage, :status)");

        // bind the placeholder names to specific script variables
        $query->bindParam(":session_id", $session_id);
        $query->bindParam(":email", $email);
        $query->bindParam(":firstname", $firstName);
        $query->bindParam(":lastname", $lastName);
        $query->bindParam(":phone", $phone);
        $query->bindParam(":address", $address);
        $query->bindParam(":square_footage", $square_footage);
        $query->bindParam(":status", $status);

        $query->execute();
    }

    /**
     * @function updateLeadBySessionId
     *
     * @param $session_id
     * @param $email
     * @param $firstName
     * @param $lastName
     * @param $phone
     * @param $address
     * @param $square_footage
     * @param int $status
     */
    public function updateLeadBySessionId($session_id, $email, $firstName, $lastName, $phone, $address, $square_footage, $status = 1)
    {

        $query = $this->pdo->prepare("UPDATE leads SET email=:email, firstname=:firstname, lastname=:lastname, phone=:phone, address=:address, square_footage=:square_footage, status=:status WHERE session_id = :session_id");

        $query->bindValue(":email", $email);
        $query->bindValue(":firstname", $firstName);
        $query->bindValue(":lastname", $lastName);
        $query->bindParam(":phone", $phone);
        $query->bindValue(":address", $address);
        $query->bindParam(":square_footage", $square_footage);
        $query->bindParam(":status", $status);

        $query->bindParam(":session_id", $session_id);

        $query->execute();
    }

    /**
     * @function getLeadBySessionId
     *
     * @param $session_id
     * @return array
     */
    public function getLeadBySessionId($session_id)
    {
        $query = $this->pdo->prepare("SELECT * FROM leads WHERE session_id = :session_id");

        $query->bindParam(":session_id", $session_id);

        $query->execute();

        $results = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * @function getLeadById
     *
     * @param int $id
     * @return array
     */
    public function getLeadById($id = 1)
    {
        $query = $this->pdo->prepare("SELECT * FROM leads WHERE id = :id");

        $query->bindParam(":id", $id);

        $query->execute();

        $results = $query->fetch(\PDO::FETCH_ASSOC);

        return $results;
    }

    /**
     * @return Collection
     */
    public function getLeads()
    {
        $query = $this->pdo->prepare("SELECT * FROM leads");

        $query->execute();

        $results = $query->fetchAll(\PDO::FETCH_ASSOC);

        $collection = new \Example\Model\Leads\Collection();

        $lead = null;

        foreach ($results as $result):

            $lead = new \Example\Model\Leads\LeadsModel();
            $lead->setId($result['id'])
                ->setSessionId($result['session_id'])
                ->setEmail($result['email'])
                ->setFirstname($result['firstname'])
                ->setLastname($result['lastname'])
                ->setPhone($result['phone'])
                ->setAddress($result['address'])
                ->setSquareFootage($result['square_footage'])
                ->setStatus($result['status'])
                ->setCreatedAt($result['created_at'])
                ->setUpdatedAt($result['updated_at']);

            $collection->setObjectArray($lead);

            $collection->next();

        endforeach;

        //$collection->setKey(0);

        return $collection;
    }

}