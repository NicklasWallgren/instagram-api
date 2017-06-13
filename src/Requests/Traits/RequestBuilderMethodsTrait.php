<?php

namespace NicklasW\Instagram\Requests\Traits;

use NicklasW\Instagram\HttpClients\Client;
use NicklasW\Instagram\Requests\Http\HeadersBuilder;
use NicklasW\Instagram\Session\Session;

trait RequestBuilderMethodsTrait
{

    /**
     * @var string The endpoint url
     */
    protected static $ENDPOINT_URL = 'https://i.instagram.com/api/v1';

    /**
     * Returns the method type.
     *
     * @return string
     */
    protected function getType(): string
    {
        return Client::METHOD_POST;
    }

    /**
     * Returns the request full uri.
     *
     * @return string
     */
    protected function getUri(): string
    {
        return sprintf('%s/%s', static::$ENDPOINT_URL, $this->getRequestUri());
    }

    /**
     * Returns the headers.
     *
     * @return array
     */
    protected function getHeaders(): array
    {
        return (new HeadersBuilder())->build($this->session);
    }

    /**
     * Returns the session.
     *
     * @return Session
     */
    abstract protected function getSession(): Session;

    /**
     * Returns the request uri.
     *
     * @return string
     */
    abstract protected function getRequestUri(): string;

}