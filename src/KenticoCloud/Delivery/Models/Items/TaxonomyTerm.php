<?php
/**
 * Represents a taxonomy term assigned to a Taxonomy element.
 */

namespace KenticoCloud\Delivery\Models\Items;

use KenticoCloud\Delivery\Models\ContentItemElement;

/**
 * Class TaxonomyTerm
 * @package KenticoCloud\Delivery\Models\Items
 */
class TaxonomyTerm extends ContentItemElement
{
    /**
     * @var string
     * Gets the name of the taxonomy term.
     */
    public $name = null;
    /**
     * @var string
     * Gets the codename of the taxonomy term.
     */
    public $codename = null;
}