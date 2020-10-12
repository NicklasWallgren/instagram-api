<?php

namespace Instagram\SDK\Responses\Serializers\Traits;

use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;

/**
 * Trait OnPropagateDecodeEventTrait
 *
 * @package Instagram\SDK\Responses\Serializers\Traits
 */
trait OnPropagateDecodeEventTrait
{

    /**
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter
     * @param array<string, mixed>  $container
     */
    public function onDecode(array $container): void
    {
        $this->propagate($container);
    }

    /**
     * Propagate the on decode event.
     *
     * @suppress PhanPartialTypeMismatchArgument
     * @param array<string, mixed> $container
     */
    protected function propagate(array $container): void
    {
        // Retrieve the defined properties
        $properties = get_object_vars($this);

        foreach ($properties as $key => $property) {
            $iterable = $property;

            // Check whether the property is of type iterable
            if (!is_iterable($property)) {
                $iterable = $this->getIterable($property);
            }

            // Check if the parent class has a specific property on decode method
            if ($this->hasOnDecodePropertyMethod($key)) {
                $this->{'onDecode' . ucfirst($key)}();
            }

            $this->invokeDecodeEventListener($iterable, $container);
        }
    }

    /**
     * Invokes the decode event listener.
     *
     * @param iterable             $iterable
     * @param array<string, mixed> $container
     */
    protected function invokeDecodeEventListener(iterable $iterable, array $container): void
    {
        foreach ($iterable as $item) {
            if ($item instanceof OnItemDecodeInterface) {
                $item->onDecode($container);
            }
        }
    }

    /**
     * Returns true if property has on decode method, false otherwise.
     *
     * @param string $property
     * @return bool
     */
    protected function hasOnDecodePropertyMethod(string $property): bool
    {
        // Compose the method name
        $method = 'onDecode' . ucfirst($property);

        return method_exists($this, $method);
    }

    /**
     * Returns a iterable.
     *
     * @param mixed $subject
     * @return iterable
     */
    protected function getIterable($subject): iterable
    {
        return [$subject];
    }
}
