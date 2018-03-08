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
class LeadsGateway
{
    /** @var \PDO $pdo */
    private $pdo;

    /** @var LeadsFactory $leadsFactory */
    private $leadsFactory;

    /** @var \Example\Model\Framework\CollectionFactory $collectionFactory */
    private $collectionFactory;

    /**
     * LeadsGateway constructor.
     *
     * @param LeadsFactory $leadsFactory
     * @param \Example\Model\Framework\CollectionFactory $collectionFactory
     * @param \PDO $pdo
     */
    public function __construct(
        \Example\Model\Leads\LeadsFactory $leadsFactory,
        \Example\Model\Framework\CollectionFactory $collectionFactory,
        \PDO $pdo
    ) {
        $this->pdo = $pdo; //\Example\Database\Connection::getInstance();
        $this->leadsFactory = $leadsFactory; //new \Example\Model\Leads\LeadsFactory();
        $this->collectionFactory = $collectionFactory; //new \Example\Model\Framework\CollectionFactory();
    }

    /**
     * @param LeadsModel $lead
     * @return LeadsModel
     */
    public function saveLead(LeadsModel $lead)
    {
        if ($lead->getId()):

            return $this->updateLead(
                $lead->getId(),
                $lead->getSessionId(),
                $lead->getEmail(),
                $lead->getFirstname(),
                $lead->getLastname(),
                $lead->getPhone(),
                $lead->getAddress(),
                $lead->getSquareFootage()
            );

        else:

            return $this->insertLead(
                $lead->getSessionId(),
                $lead->getEmail(),
                $lead->getFirstname(),
                $lead->getLastname(),
                $lead->getPhone(),
                $lead->getAddress(),
                $lead->getSquareFootage()
            );

        endif;
    }

    /**
     * @param $id
     * @param $session_id
     * @param $email
     * @param $firstName
     * @param $lastName
     * @param $phone
     * @param $address
     * @param $square_footage
     * @param int $status
     * @return LeadsModel
     */
    private function updateLead($id, $session_id, $email, $firstName, $lastName, $phone, $address, $square_footage, $status = 1)
    {
        $query = $this->pdo->prepare("UPDATE leads SET session_id=:session_id, email=:email, firstname=:firstname, lastname=:lastname, phone=:phone, address=:address, square_footage=:square_footage, status=:status WHERE id = :id");

        $query->bindParam(":session_id", $session_id);
        $query->bindValue(":email", $email);
        $query->bindValue(":firstname", $firstName);
        $query->bindValue(":lastname", $lastName);
        $query->bindParam(":phone", $phone);
        $query->bindValue(":address", $address);
        $query->bindParam(":square_footage", $square_footage);
        $query->bindParam(":status", $status);

        $query->bindParam(":id", $id);

        $query->execute();

        return $this->getLeadById($id);
    }

    /**
     * @param $session_id
     * @param $email
     * @param $firstName
     * @param $lastName
     * @param $phone
     * @param $address
     * @param $square_footage
     * @param int $status
     * @return LeadsModel
     */
    private function insertLead ($session_id, $email, $firstName, $lastName, $phone, $address, $square_footage, $status = 1)
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

        return $this->getLeadById($this->pdo->lastInsertId());
    }

    /**
     * @param $session_id
     * @param $email
     * @param $firstName
     * @param $lastName
     * @param $phone
     * @param $address
     * @param $square_footage
     * @param int $status
     * @return mixed|null
     */
    private function updateLeadBySessionId($session_id, $email, $firstName, $lastName, $phone, $address, $square_footage, $status = 1)
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

        return $this->getLeadsBySessionId($session_id)->getFirstItem();
    }

    /**
     * @param $session_id
     * @return \Example\Model\Framework\Collection
     */
    public function getLeadsBySessionId($session_id)
    {
        $query = $this->pdo->prepare("SELECT * FROM leads WHERE session_id = :session_id");

        $query->bindParam(":session_id", $session_id);

        $query->execute();

        $results = $query->fetchAll(\PDO::FETCH_ASSOC);

        $collection = $this->setCollection($results);

        return $collection;
    }

    /**
     * @param int $id
     * @return LeadsModel
     */
    public function getLeadById($id = 1)
    {
        $query = $this->pdo->prepare("SELECT * FROM leads WHERE id = :id");

        $query->bindParam(":id", $id);

        $query->execute();

        $result = $query->fetch(\PDO::FETCH_ASSOC);

        $lead = $this->setLead($result);

        return $lead;
    }

    /**
     * @return \Example\Model\Framework\Collection
     */
    public function getLeads()
    {
        $query = $this->pdo->prepare("SELECT * FROM leads");

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
        $collection = new \Example\Model\Framework\Collection();

        foreach ($results as $result):

            $lead = $this->setLead($result);

            $collection->setObjectArray($lead);

            $collection->next();

        endforeach;

        return $collection;

    }

    /**
     * @param array $result
     * @return LeadsModel
     */
    private function setLead(array $result)
    {
        $lead = $this->leadsFactory->create();

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

        return $lead;
    }

}