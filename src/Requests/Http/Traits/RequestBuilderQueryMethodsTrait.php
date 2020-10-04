<?php

namespace Instagram\SDK\Requests\Http\Traits;

use Instagram\SDK\Requests\Traits\RequestBuilderMethodsTrait;

/**
 * Trait RequestBuilderQueryMethodsTrait
 *
 * @package Instagram\SDK\Requests\Http\Traits
 */
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
     * @return array<string, mixed>
     */
    protected function getQueryParameters(): array
    {
        return [];
    }

    /**
     * Returns the method uri parameters.
     *
     * @return array<string, mixed>
     */
    protected function getMethodUriParameters(): array
    {
        return [];
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
        // @phan-suppress-next-line PhanPluginPrintfVariableFormatString,PhanTypeMismatchUnpackKey
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
        // Compose the query parameters
        if (($parameters = http_build_query($this->getQueryParameters(), '', '&')) == null) {
            return null;
        }

        return '?' . $parameters;
    }
}
