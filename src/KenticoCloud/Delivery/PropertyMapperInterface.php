<?php
/**
 * TODO: RC
 */

namespace KenticoCloud\Delivery;

/**
 * Interface PropertyMapperInterface
 * @package KenticoCloud\Delivery
 */
interface PropertyMapperInterface
{
    /**
     * TODO: RC
     * @param $data
     * @param $modelType
     * @param $property
     * @return mixed
     */
    public function getProperty($data, $modelType, $property);
}