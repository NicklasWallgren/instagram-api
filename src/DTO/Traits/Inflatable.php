<?php

namespace Instagram\SDK\DTO\Traits;

use Instagram\SDK\DTO\Interfaces\PropertiesInterface;

/**
 * Trait Inflatable
 *
 * @package Instagram\SDK\DTO\Traits
 */
trait Inflatable
{

    /**
     * Inflates the instance with properties.
     *
     * @param array<string, mixed>|PropertiesInterface $properties
     * @return static
     */
    public function inflate($properties)
    {
        // Retrieve the properties
        $properties = $this->properties($properties);

        foreach ($properties as $property => $value) {
            if ($value instanceof PropertiesInterface) {
                $this->inflate($value);
            }

            $this->inflateProperty($property, $value);
        }

        return $this;
    }

    /**
     * Inflate a property.
     *
     * @param string $property
     * @param mixed  $value
     */
    protected function inflateProperty(string $property, $value): void
    {
        // Check whether the property exists
        if (!property_exists($this, $property)) {
            return;
        }

        // Check whether a setter method is defined
        if (!$this->hasSubjectSetterMethod($property)) {
            return;
        }

        $this->{'set' . ucfirst($property)}($value);
    }

    /**
     * Returns true if the setter method exits, false otherwise.
     *
     * @param string $property
     * @return bool
     */
    protected function hasSubjectSetterMethod($property): bool
    {
        // Compose the method name
        $method = 'set' . ucfirst($property);

        return method_exists($this, $method);
    }

    /**
     * Returns the properties.
     *
     * @param array|PropertiesInterface $subject
     * @return array<string, mixed>
     */
    protected function properties($subject): array
    {
        if ($subject instanceof PropertiesInterface) {
            return $subject->getProperties();
        }

        return $subject;
    }
}
