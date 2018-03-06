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
 * Class LeadBlock
 * @package Example\Block\Pages
 */
class LeadBlock
{

    private $title = 'View Lead';

    /** @var Leads $leads */
    private $leads;

    private $all_leads = null;
    private $single_lead = null;

    public function __construct()
    {
        $this->leads = new Leads();
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getLead()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 1;

        try {
            $this->single_lead = $this->leads->getLeadById($id);
        } catch (\Exception $exception) {

        }

        return $this->single_lead;
    }
}