<?php

namespace Instagram\SDK\Responses\Serializers\Traits;

use Exception;
use Instagram\SDK\Responses\Serializers\Interfaces\OnDecodeRequirementsInterface;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;

trait OnPropagateDecodeEventTrait
{

    use RequirementsParserMethodsTrait;

    /**
     * On item decode method.
     *
     * @param array $container
     * @param array $requirements
     */
    public function onDecode(array $container, $requirements = []): void
    {
        $this->propagate($container);
    }

    /**
     * Propagate the on decode event.
     *
     * @param array $container
     */
    protected function propagate($container): void
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
     * @param iterable $iterable
     * @param array    $container
     */
    protected function invokeDecodeEventListener(iterable $iterable, array $container)
    {
        foreach ($iterable as $item) {
            if ($item instanceof OnItemDecodeInterface) {
                // The item decode requirements
                $requirements = [];

                if ($this->hasRequirements($item)) {
                    $requirements = $this->getRequirements($subject = $item);

                    $this->setRequirementsIfPossible($requirements, $subject);
                }

                $item->onDecode($container, $requirements);
            }
        }
    }

    /**
     * Set requirements if possible.
     *
     * @param array  $requirements
     * @param object $subject
     */
    protected function setRequirementsIfPossible($requirements, $subject)
    {
        foreach ($requirements as $property => $requirement) {
            if (!$this->hasSetterMethod($subject, $property)) {
                continue;
            }

            $subject->{'set' . ucfirst($property)}($requirement);
        }
    }

    /**
     * Returns true if property has on decode method, false otherwise.
     *
     * @param string $property
     * @return bool
     */
    protected function hasOnDecodePropertyMethod($property): bool
    {
        // Compose the method name
        $method = 'onDecode' . ucfirst($property);

        return method_exists($this, $method);
    }

    /**
     * Returns true if the setter method exits, false otherwise.
     *
     * @param object $subject
     * @param string $property
     * @return bool
     */
    protected function hasSetterMethod($subject, $property): bool
    {
        // Compose the method name
        $method = 'set' . ucfirst($property);

        return method_exists($subject, $method);
    }

    /**
     * Returns true if the subject has requirement, false otherwise.
     *
     * @param mixed $subject
     * @return bool
     */
    protected function hasRequirements($subject): bool
    {
        return $subject instanceof OnDecodeRequirementsInterface;
    }

    /**
     * Returns the list of subject requirements.
     *
     * @param OnDecodeRequirementsInterface $subject
     * @return array
     */
    protected function getRequirements(OnDecodeRequirementsInterface $subject): array
    {
        $requirements = [];

        foreach ($subject->requirements() as &$requirement) {
            $requirements[$requirement] = $this->getRequirement($subject, $requirement);
        }

        return $requirements;
    }

    /**
     * Returns the requirement
     *
     * @param OnDecodeRequirementsInterface $subject
     * @param string                        $requirement
     * @return mixed
     * @throws Exception
     */
    protected function getRequirement(OnDecodeRequirementsInterface $subject, string &$requirement)
    {
        // Decompose the requirements
        ['property' => $property, 'parameters' => $parameters] = $this->parse($requirement);

        // Compose the getter method
        $method = 'get' . ucfirst($property);

        // Check whether the getter method is defined
        if (!method_exists($this, $method)) {
            throw new Exception(sprintf('Could not derive decode requirement. %s', $property));
        }

        // Retrieve the required parameter value
        $parameters = array_map(function (string $parameter) use ($subject) {
            return $this->getRequirementParameterValue($subject, $parameter);
        }, $parameters);

        $requirement = $property;

        return $this->$method(...$parameters);
    }

    /**
     * Returns the requirement parameter value.
     *
     * @param OnDecodeRequirementsInterface $subject
     * @param string                        $parameter
     * @return mixed
     * @throws Exception
     */
    protected function getRequirementParameterValue(OnDecodeRequirementsInterface $subject, string $parameter)
    {
        // Compose the getter method
        $method = 'get' . ucfirst($parameter);

        // Check whether the getter method is defined
        if (!method_exists($subject, $method)) {
            throw new Exception(sprintf('Could not derive parameter requirement method. %s', $parameter));
        }

        return $subject->$method();
    }

    /**
     * Returns the parent instance.
     *
     * @return static
     */
    protected function getParent()
    {
        return $this;
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
