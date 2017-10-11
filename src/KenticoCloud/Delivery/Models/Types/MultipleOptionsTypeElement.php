<?php
/**
 * Represents content type element with possibility to select from multiple choices.
 */

namespace KenticoCloud\Delivery\Models\Types;

use \KenticoCloud\Delivery\Models;

/**
 * Class MultipleOptionsTypeElement
 * @package KenticoCloud\Delivery\Models\Types
 */
class MultipleOptionsTypeElement extends ContentTypeElement
{
    /**
     * TODO: RC
     * @var null
     */
    public $options = null;

    /**
     * MultipleOptionsTypeElement constructor.
     * @param $type
     * @param $codename
     * @param $name
     * @param $options
     */
    public function __construct($type, $codename, $name, $options)
    {
        $this->options = $options;
        parent::__construct($type, $codename, $name);
    }
}
