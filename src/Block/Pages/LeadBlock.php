<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/5/18
 * Time: 3:13 PM
 */
namespace Example\Block\Pages;

use \Example\Model\Leads\LeadsGateway;

/**
 * Class LeadBlock
 * @package Example\Block\Pages
 */
class LeadBlock
{
    /** @var string $title */
    private $title = 'View Lead';

    /** @var LeadsGateway $leadsGateway */
    private $leadsGateway;

    /** @var $single_lead */
    private $single_lead;

    /**
     * LeadBlock constructor.
     */
    public function __construct(\Example\Model\Leads\LeadsGateway $gateway)
    {
        $this->leadsGateway = $gateway;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return \Example\Model\Leads\LeadsModel
     */
    public function getLead()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 1;

        try {
            $this->single_lead = $this->leadsGateway->getLeadById($id);
        } catch (\Exception $exception) {

        }

        return $this->single_lead;
    }
}