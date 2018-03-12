<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/11/18
 * Time: 8:49 PM
 */

namespace Example\Utility;

/**
 * Class Pagination
 * @package Example\Utility
 */
class Pagination
{
    /** @var \Example\Model\Framework\CollectionFactory $collectionFactory */
    private $collectionFactory;

    private $page_size = 10;

    private $page = 1;

    private $collection;


    /**
     * Pagination constructor.
     * @param \Example\Model\Framework\CollectionFactory $collectionFactory
     */
    public function __construct(\Example\Model\Framework\CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param integer $pageSize
     * @return $this
     */
    public function setPageSize($pageSize)
    {
        $this->page_size = $pageSize;
        return $this;
    }

    /**
     * @param integer $page
     * @return $this
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param \Example\Model\Framework\Collection $collection
     * @return $this
     */
    public function setCollection(\Example\Model\Framework\Collection $collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * @return \Example\Model\Framework\Collection
     */
    public function getPagedCollection()
    {
        $count = $this->collection->count();

        $pagedCollection = $this->collectionFactory->create();

        for ($x = (($this->page_size * $this->page) - $this->page_size); $x <= (($this->page_size * $this->page) - 1); $x++) {
            if ($x < $count):
                $pagedCollection->setObjectArray($this->collection->getItemByKey($x));
                $pagedCollection->next();
            else:
                continue;
            endif;

        }

        return $pagedCollection;

    }

    /**
     * @return float
     */
    public function getNumberOfPages()
    {
        $count = $this->collection->count();
        $numberOfPages = (integer) ceil($count / $this->page_size);

        return $numberOfPages;
    }

    /**
     * @return int
     */
    public function getPageSize()
    {
        return $this->page_size;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return mixed
     */
    public function getCollection()
    {
        return $this->collection;
    }
}