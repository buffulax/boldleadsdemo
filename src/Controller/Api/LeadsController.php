<?php

namespace Example\Controller\Api;

/**
 * Class LeadsController
 */
class LeadsController {

    /** @var \Example\Model\Leads\Leads $leads */
    private $leads;

    /**
     * LeadsController constructor.
     */
    public function __construct()
    {
        $this->leads = new \Example\Model\Leads\Leads();
    }

    /**
     * @function get
     *
     * @return array
     */
    public function get() {

        $results = $this->leads->getLeads();

        return $results;
    }

    /**
     * @function create
     *
     * @return void
     */
    public function create() {

        $result = [
            'success' => false,
            'message' => ''
        ];

        $session_id = session_id();
        $email = $_POST['email'];
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $square_footage = $_POST['square_footage'];

        $lead = $this->leads->getLeadBySessionId(session_id());

        try {
            if (count($lead) > 0){
                $this->leads->updateLeadBySessionId($session_id, $email, $firstName, $lastName, $phone, $address, $square_footage);
            } else {
                $this->leads->insertLead($session_id, $email, $firstName, $lastName, $phone, $address, $square_footage);
            }

            $result['success'] = true;
        } catch (\Exception $exception) {
            $result['message'] = $exception->getMessage();
        }

        $result['all_data'] = $this->leads->getLeadBySessionId($session_id);

        echo json_encode($result);
    }
}