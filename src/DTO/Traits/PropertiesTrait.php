<?php

namespace Instagram\SDK\DTO\Traits;

trait PropertiesTrait
{

    /**
     * Returns the properties.
     *
     * @return array
     */
    public function getProperties(): array
    {
        return get_object_vars($this);
    }
}
