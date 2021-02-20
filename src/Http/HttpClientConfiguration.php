<?php

namespace Instagram\SDK\Http;

/**
 * Class Options
 *
 * @package Instagram\SDK\Http
 */
class HttpClientConfiguration
{

    /**
     * @var string Proxy attribute
     */
    private const ATTRIBUTE_PROXY_OPTION = 'proxy';

    /**
     * @var array<string, mixed>
     */
    private $attributes = [];

    /**
     * Adds proxy uri.
     *
     * @param string $uri
     * @return HttpClientConfiguration|static
     */
    public function addProxyUri(string $uri): self
    {
        $this->addAttribute(static::ATTRIBUTE_PROXY_OPTION, $uri);

        return $this;
    }

    /**
     * Append attribute to the list of attributes.
     *
     * @param string $attribute
     * @param mixed  $value
     * @return HttpClientConfiguration|static
     */
    private function addAttribute(string $attribute, $value): self
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * Returns the attributes list.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->attributes;
    }

}
