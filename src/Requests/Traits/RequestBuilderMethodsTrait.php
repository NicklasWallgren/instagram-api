<?php

namespace Instagram\SDK\Requests\Traits;

use Instagram\SDK\Http\RequestClient;
use Instagram\SDK\Requests\Http\HeadersBuilder;
use Instagram\SDK\Session\Session;

/**
 * Trait RequestBuilderMethodsTrait
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait RequestBuilderMethodsTrait
{

    /**
     * @var string The endpoint url
     */
    protected static $ENDPOINT_URL = 'https://i.instagram.com/api/v1';

    /**
     * @var Session
     */
    protected $session;

    /**
     * Returns the method type.
     *
     * @return string
     */
    protected function getType(): string
    {
        return RequestClient::METHOD_POST;
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
     * @return array<string, mixed>
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
