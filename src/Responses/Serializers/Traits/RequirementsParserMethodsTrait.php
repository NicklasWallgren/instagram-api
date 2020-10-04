<?php

namespace Instagram\SDK\Responses\Serializers\Traits;

/**
 * Trait RequirementsParserMethodsTrait
 *
 * @package Instagram\SDK\Responses\Serializers\Traits
 */
trait RequirementsParserMethodsTrait
{

    /**
     * Parses the requirements.
     *
     * @suppress PhanUnusedVariable
     * @param string $requirement
     * @return array<string, mixed>
     */
    public function parse(string $requirement): array
    {
        @list($property, $parameters) = explode(':', $requirement);

        $parameters = $this->parseParameters($parameters);

        return compact('property', 'parameters');
    }

    /**
     * Parses the parameters.
     *
     * @param string|null $parameters
     * @return array<string, mixed>
     */
    private function parseParameters(?string $parameters)
    {
        return $parameters !== null? explode(',', $parameters) : [];
    }
}
