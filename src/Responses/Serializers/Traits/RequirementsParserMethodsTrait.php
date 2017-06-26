<?php

namespace NicklasW\Instagram\Responses\Serializers\Traits;

trait RequirementsParserMethodsTrait
{

    /**
     * Parses the requirements.
     *
     * @param string $requirement
     * @return array
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
     * @return array
     */
    private function parseParameters($parameters)
    {
        return $parameters !== null? explode(',', $parameters) : [];
    }
}
