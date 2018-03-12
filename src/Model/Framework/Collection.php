<?php
/**
 * Created by PhpStorm.
 * User: ccarlson79
 * Date: 3/6/18
 * Time: 3:46 PM
 */
namespace Example\Model\Framework;

/**
 * Class Collection
 * @package Example\Model\Leads
 */
class Collection implements \Iterator, \Countable, ToArray
{
    /** @var array $objectArray */
    private $objectArray = [];

    public function rewind()
    {
        reset($this->objectArray);
    }

    public function current()
    {
        $var = current($this->objectArray);
        return $var;
    }

    public function key()
    {
        $var = key($this->objectArray);
        return $var;
    }

    public function next()
    {
        $var = next($this->objectArray);
        return $var;
    }

    public function valid()
    {
        $key = key($this->objectArray);
        $var = ($key !== NULL && $key !== FALSE);
        return $var;
    }

    public function count()
    {
        return count($this->objectArray);
    }

    /**
     * @return mixed
     */
    public function getObjectArray()
    {
        return $this->objectArray;
    }

    /**
     * @param $object
     */
    public function setObjectArray($object)
    {
        $this->objectArray[] = $object;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $arr = [];

        foreach ($this->objectArray as $item):

            $arr[] = $item->toArray();

        endforeach;

        return $arr;
    }

    /**
     * @return mixed|null
     */
    public function getFirstItem()
    {
        if ($this->count()):
            return $this->objectArray[0];
        else:
            return null;
        endif;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getItemByKey($key)
    {
        if ($key < $this->count()):
            return $this->objectArray[$key];
        else:
            return null;
        endif;
    }
}