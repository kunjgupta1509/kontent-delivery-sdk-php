<?php

/**
 * Default implementation of the TypeMapperInterface.
 */

namespace KenticoCloud\Delivery;

use KenticoCloud\Delivery\Helpers\TextHelper;
use KenticoCloud\Delivery\Models\Items\ContentItemSystem;

/**
 * Class DefaultMapper serves for resolving strong types based on provided information.
 */
class DefaultMapper implements TypeMapperInterface, PropertyMapperInterface, ValueConverterInterface
{
    const ELEMENTS_ATTRIBUTE_NAME = 'elements';

    /**
     * Generic content item model.
     *
     * @var string
     */
    protected $ci = \KenticoCloud\Delivery\Models\Items\ContentItem::class;

    /**
     * Gets strong type based on provided information.
     *
     * @param $typeName name of the type to get (should be a primary source type resolution)
     * @param null $elementName     name of the property whose type should be resolved
     * @param null $parentModelType type of class where the $elementName resides
     *
     * @return null|string
     */
    public function getTypeClass($typeName, $elementName = null)
    {
        $type = null;
        if ($typeName != null) {
            switch ($typeName) {
                case 'asset':
                    $type = \KenticoCloud\Delivery\Models\Items\Asset::class;
                    break;
                case 'taxonomy':
                    $type = \KenticoCloud\Delivery\Models\Items\TaxonomyTerm::class;
                    break;
                case 'multiple_choice':
                    $type = \KenticoCloud\Delivery\Models\Items\MultipleChoiceOption::class;
                    break;
                default:
                    $type = $this->ci;
                    break;
            }
        }

        return $type;
    }

    /**
     * Returns the correct element from $data based on $modelType and $property.
     *
     * @param $data source data (deserialized JSON)
     * @param $modelType target model type
     * @param $property target property name
     *
     * @return mixed
     */
    public function getProperty($data, $modelType, $property)
    {
        if ($property == self::ELEMENTS_ATTRIBUTE_NAME && $modelType == $this->ci) {
            return get_object_vars($data[self::ELEMENTS_ATTRIBUTE_NAME]);
        } else {
            $index = TextHelper::getInstance()->decamelize($property);
            if (!array_key_exists($index, $data)) {
                // Custom model, search in elements
                $data = get_object_vars($data[self::ELEMENTS_ATTRIBUTE_NAME]);
            }

            return $data[$index];
        }
    }

    /**
     * Converts a given simple value to a specified type.
     *
     * @param $type type to convert the value to
     * @param $value value to convert
     *
     * @return mixed
     */
    public function getValue($type, $value)
    {
        $result = $value;
        if ($type != null) {
            switch ($type) {
                case 'system':
                    $result = new ContentItemSystem($value->id, $value->name, $value->codename, $value->last_modified, $value->type, $value->sitemap_locations, $value->language);
                    break;
                case 'date_time':
                    $result = new \DateTime($value);
                    break;
                case 'number':
                    $result = (float) $value;
                    break;
            }
        }

        return $result;
    }
}
