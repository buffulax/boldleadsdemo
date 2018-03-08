<?php

namespace Example\Controller\Api;

use \Example\Model\Leads\LeadsModel;

/**
 * Class LeadsController
 */
class LeadsController {

    /** @var \Example\Model\Leads\LeadsGateway $leadsGateway */
    private $leadsGateway;

    /**
     * LeadsController constructor.
     * @param \Example\Model\Leads\LeadsGateway $gateway
     */
    public function __construct(\Example\Model\Leads\LeadsGateway $gateway)
    {
        $this->leadsGateway = $gateway;
    }

    /**
     * @function get Action
     */
    public function get() {

        $leadsCollection = $this->leadsGateway->getLeads();

        echo json_encode($leadsCollection->toArray());
    }

    /**
     * @function create Action
     *
     * @return void
     */
    public function create() {

        $result = [
            'success' => false,
            'message' => ''
        ];

        $session_id = session_id();

        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $firstName = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $lastName = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $square_footage = isset($_POST['square_footage']) ? $_POST['square_footage'] : '';

        $lead = $this->leadsGateway->getLeadsBySessionId($session_id)->getFirstItem();

        if (is_null($lead)){
            $lead = new LeadsModel();
        }

        $lead->setSessionId($session_id)
            ->setEmail($email)
            ->setFirstname($firstName)
            ->setLastname($lastName)
            ->setPhone($phone)
            ->setAddress($address)
            ->setSquareFootage($square_footage);

        try {

            $updatedLead = $this->leadsGateway->saveLead($lead);

            $result['return_data'] = $updatedLead->toArray();
            $result['success'] = true;

        } catch (\Exception $exception) {
            $result['message'] = 'Error Getting Records: '.$exception->getMessage();
        }

        echo json_encode($result);
    }
}