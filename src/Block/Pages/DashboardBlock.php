<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/5/18
 * Time: 3:13 PM
 */
namespace Example\Block\Pages;

use \Example\Model\Framework\Collection;
use \Example\Model\Leads\LeadsGateway;

/**
 * Class DashboardBlock
 * @package Example\Block\Pages
 */
class DashboardBlock {

    /** @var string $title */
    private $title = 'Dashboard';

    /** @var LeadsGateway $leadsGateway */
    private $leadsGateway;

    /** @var Collection $leads */
    private $all_leads;

    /**
     * DashboardBlock constructor.
     */
    public function __construct(LeadsGateway $gateway)
    {
        $this->leadsGateway = $gateway;
        //$this->leadsGateway = new LeadsGateway();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return Collection
     */
    public function getAllLeads()
    {
        if (is_null($this->all_leads)) {
            $this->all_leads = $this->leadsGateway->getLeads();
        }

        return $this->all_leads;
    }
}