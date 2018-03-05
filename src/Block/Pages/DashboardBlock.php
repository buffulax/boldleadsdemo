<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/5/18
 * Time: 3:13 PM
 */
namespace Example\Block\Pages;

use \Example\Model\Leads\Leads;

/**
 * Class DashboardBlock
 * @package Example\Block\Pages
 */
class DashboardBlock {

    private $title = 'Dashboard';

    /** @var Leads $leads */
    private $leads;

    private $all_leads = null;

    public function __construct()
    {
        $this->leads = new Leads();
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAllLeads()
    {
        if (is_null($this->all_leads)) {
            $this->all_leads = $this->leads->getLeads();
        }

        return $this->all_leads;
    }
}