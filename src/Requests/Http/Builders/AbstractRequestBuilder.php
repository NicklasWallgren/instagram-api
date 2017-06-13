<?php

namespace NicklasW\Instagram\Requests\Http\Builders;

use GuzzleHttp\Psr7\Request;
use NicklasW\Instagram\Session\Session;

abstract class AbstractRequestBuilder
{

    /**
     * @var string The endpoint url
     */
    protected static $ENDPOINT_URL = 'https://i.instagram.com/api/v1';

    /**
     * @var string The request uri
     */
    protected static $REQUEST_URI = null;

    /**
     * @var Session
     */
    protected $session;

    /**
     * AbstractRequestBuilder constructor.
     *
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Builds HTTP request.
     *
     * @return Request
     */
    public function build(): Request
    {
        return new Request(
            $this->getType(),
            $this->getUri(),
            $this->getHeaders(),
            $this->getBody());
    }

    /**
     * Returns the session.
     *
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->session;
    }

    /**
     * Returns the request uri.
     *
     * @return string
     */
    protected function getRequestUri(): string
    {
        return static::$REQUEST_URI;
    }

    /**
     * Returns the method type.
     *
     * @return string
     */
    abstract protected function getType(): string;

    /**
     * Returns the request full uri.
     *
     * @return string
     */
    abstract protected function getUri(): string;

    /**
     * Returns the default headers.
     *
     * @return array
     */
    abstract protected function getHeaders(): array;

    /**
     * Returns the payload.
     *
     * @return string|null
     */
    abstract protected function getBody(): ?string;

}