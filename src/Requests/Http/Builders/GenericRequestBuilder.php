<?php

namespace NicklasW\Instagram\Requests\Http\Builders;

use NicklasW\Instagram\Requests\Http\Traits\CommonSerializerTrait;
use NicklasW\Instagram\Requests\Http\Traits\RequestBuilderQueryMethodsTrait;
use NicklasW\Instagram\Session\Session;

class GenericRequestBuilder extends AbstractPayloadRequestBuilder
{

    use RequestBuilderQueryMethodsTrait;
    use CommonSerializerTrait;

    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * @var array
     */
    protected $payload = [];

    /**
     * @var string
     */
    protected $uri;

    /**
     * GenericRequestBuilder constructor.
     *
     * @param string  $uri
     * @param Session $session
     */
    public function __construct(string $uri, Session $session)
    {
        $this->uri = $uri;

        parent::__construct($session);
    }

    /**
     * Sets a post parameter.
     *
     * @param string $name
     * @param mixed  $value
     * @return GenericRequestBuilder
     */
    public function setPost(string $name, $value): GenericRequestBuilder
    {
        $this->payload[$name] = $value;

        return $this;
    }

    /**
     * Sets a query parameter.
     *
     * @param string $name
     * @param mixed  $value
     * @return GenericRequestBuilder
     */
    public function setParam(string $name, $value): GenericRequestBuilder
    {
        $this->parameters[$name] = $value;

        return $this;
    }

    /**
     * Returns the body parameters.
     *
     * @return array
     */
    protected function getBodyParameters(): array
    {
        return $this->payload;
    }

    /**
     * Returns the query parameters.
     *
     * @return array
     */
    protected function getQueryParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Returns the request uri.
     *
     * @return string
     */
    protected function getRequestUri(): string
    {
        return $this->uri;
    }

}