<?php
/**
 * TODO: RC
 */

namespace KenticoCloud\Delivery\Helpers;

/**
 * Class Singleton
 * @package KenticoCloud\Delivery\Helpers
 */
abstract class Singleton
{
    /**
     * Singleton constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Get Singleton instance.
     * TODO: RC
     * @return mixed
     */
    final public static function getInstance()
    {
        static $aoInstance = array();

        $calledClassName = get_called_class();

        if (!isset($aoInstance[$calledClassName]))
        {
            $aoInstance[$calledClassName] = new $calledClassName();
        }

        return $aoInstance[$calledClassName];
    }

    /**
     * TODO: RC
     */
    final private function __clone()
    {
    }
}
