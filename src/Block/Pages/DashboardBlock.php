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

    /** @var \Example\Utility\Pagination $pagination */
    private $pagination;

    /** @var Collection $leads */
    private $all_leads;

    /** @var Collection $paged_leads */
    private $paged_leads;

    /**
     * DashboardBlock constructor.
     *
     * @param LeadsGateway $gateway
     * @param \Example\Utility\Pagination $pagination
     */
    public function __construct(
        LeadsGateway $gateway,
        \Example\Utility\Pagination $pagination
    ) {
        $this->leadsGateway = $gateway;
        $this->pagination = $pagination;
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

    /**
     * @return Collection
     */
    public function getPagedLeads()
    {
        $this->getAllLeads();

        if (is_null($this->paged_leads)) {

            $this->paged_leads = $this->setPagination()->getPagedCollection();
        }

        return $this->paged_leads;
    }

    /**
     * @return integer
     */
    public function getNumberOfPages()
    {
        return $this->setPagination()->getNumberOfPages();
    }

    /**
     * @return \Example\Utility\Pagination
     */
    public function setPagination()
    {
        $page_size = (isset($_GET['ps'])) ? $_GET['ps'] : 10;
        $page = (isset($_GET['p'])) ? $_GET['p'] : 1;

        return $this->pagination->setPageSize($page_size)->setPage($page)->setCollection($this->getAllLeads());
    }
}