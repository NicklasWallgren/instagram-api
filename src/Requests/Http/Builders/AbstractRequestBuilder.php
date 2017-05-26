<?php

namespace NicklasW\Instagram\Requests\Http\Builders;

use GuzzleHttp\Psr7\Request;
use NicklasW\Instagram\Requests\Http\HeadersBuilder;
use NicklasW\Instagram\Requests\Http\Marshallers\SerializerInterface;
use NicklasW\Instagram\Session\Session;

abstract class AbstractRequestBuilder
{

    /**
     * @var string The endpoint url
     */
    protected const ENDPOINT_URL = 'https://i.instagram.com/api/v1';

    /**
     * @var string The request uri
     */
    protected const REQUEST_URI = null;

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
    abstract public function build(): Request;

    /**
     * Returns the default headers.
     *
     * @return array
     */
    protected function getHeaders(): array
    {
        return (new HeadersBuilder())->build($this->session);
    }

    /**
     * Returns the request full uri.
     *
     * @return string
     */
    protected function getUri(): string
    {
        return sprintf('%s/%s', static::ENDPOINT_URL, static::REQUEST_URI);
    }

}