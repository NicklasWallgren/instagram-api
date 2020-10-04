<?php

namespace Instagram\SDK\DTO\Traits;

/**
 * Trait PropertiesTrait
 *
 * @package Instagram\SDK\DTO\Traits
 */
trait PropertiesTrait
{

    /**
     * Returns the properties.
     *
     * @return array<string, mixed>
     */
    public function getProperties(): array
    {
        return get_object_vars($this);
    }
}
