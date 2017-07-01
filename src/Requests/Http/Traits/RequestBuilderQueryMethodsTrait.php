<?php

namespace Instagram\SDK\Requests\Http\Traits;

use Instagram\SDK\Requests\Traits\RequestBuilderMethodsTrait;

trait RequestBuilderQueryMethodsTrait
{

    use RequestBuilderMethodsTrait {
        getUri as protected getBaseUri;
    }

    /**
     * @var string The uri template
     */
    protected static $URI_TEMPLATE = null;

    /**
     * Returns the query parameters.
     *
     * @return array
     */
    protected function getQueryParameters(): array
    {
        return $parameters = [];
    }

    /**
     * Returns the method uri parameters.
     *
     * @return array
     */
    protected function getMethodUriParameters(): array
    {
        return $parameters = [];
    }

    /**
     * Returns the request full uri.
     *
     * @return string
     */
    protected function getUri(): string
    {
        return sprintf('%s%s', $this->getBaseUri(), $this->getMethodUri());
    }

    /**
     * Returns the method uri.
     *
     * @return string
     */
    protected function getMethodUri(): string
    {
        // Compose the method uri
        $methodUri = sprintf(static::$URI_TEMPLATE, ...$this->getMethodUriParameters());

        return sprintf('%s%s', $methodUri, $this->getQuery());
    }

    /**
     * Returns the query.
     *
     * @return null|string
     */
    protected function getQuery(): ?string
    {
        return '?' . http_build_query($this->getQueryParameters(), '', '&');
    }
}
