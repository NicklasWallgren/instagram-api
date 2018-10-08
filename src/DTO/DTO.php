<?php

namespace Instagram\SDK\DTO;

use Instagram\SDK\DTO\Interfaces\PropertiesInterface;
use Instagram\SDK\DTO\Traits\Inflatable;
use Instagram\SDK\DTO\Traits\PropertiesTrait;

/**
 * Class DTO
 *
 * @package Instagram\SDK\DTO
 */
abstract class DTO implements PropertiesInterface
{

    use Inflatable;
    use PropertiesTrait;

    /**
     * Creates a instance using properties.
     *
     * @param array|PropertiesInterface $properties
     * @return static
     */
    public static function create($properties)
    {
        $instance = new static();

        return $instance->inflate($properties);
    }
}
