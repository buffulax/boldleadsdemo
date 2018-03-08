<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/7/18
 * Time: 12:18 PM
 */

namespace Example\Model\Framework;

/**
 * Class CollectionFactory
 * @package Example\Model\Framework
 */
class CollectionFactory implements Factory
{
    /**
     * @return Collection
     */
    public function create()
    {
        return new \Example\Model\Framework\Collection();
    }
}