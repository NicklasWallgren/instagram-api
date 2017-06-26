<?php

namespace NicklasW\Instagram\DTO;

use NicklasW\Instagram\DTO\Interfaces\PropertiesInterface;
use NicklasW\Instagram\DTO\Traits\Inflatable;
use NicklasW\Instagram\DTO\Traits\PropertiesTrait;

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
