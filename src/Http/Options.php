<?php

namespace Instagram\SDK\Http;

class Options
{

    /**
     * @var string Proxy attribute
     */
    protected const ATTRIBUTE_PROXY_OPTION = 'proxy';

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * Adds proxy uri.
     *
     * @param string $uri
     * @return Options|static
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
     * @return Options|static
     */
    protected function addAttribute(string $attribute, $value): self
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * Returns the attributes list.
     *
     * @return array
     */
    public function get(): array
    {
        return $this->attributes;
    }

    /**
     * Returns the attributes list.
     *
     * @return array
     */
    public function __invoke()
    {
        return $this->get();
    }
}
