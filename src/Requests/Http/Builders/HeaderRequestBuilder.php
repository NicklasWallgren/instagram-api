<?php

namespace NicklasW\Instagram\Requests\Http\Builders;

use GuzzleHttp\Psr7\Request;
use NicklasW\Instagram\HttpClients\Client;
use NicklasW\Instagram\Requests\Http\Marshallers\SerializerInterface;
use NicklasW\Instagram\Requests\Http\Marshallers\UrlEncodedSerializer;
use NicklasW\Instagram\Session\Session;

class HeaderRequestBuilder extends AbstractRequestBuilder
{

    /**
     * @var string The login request URI
     */
    protected const REQUEST_URI = 'si/fetch_headers/';

    /**
     * @var string The signature
     */
    protected $signature;

    /**
     * HeaderRequestBuilder constructor.
     *
     * @param string  $signature
     * @param Session $session
     */
    public function __construct(string $signature, Session $session)
    {
        $this->signature = $signature;

        parent::__construct($session);
    }

    /**
     * Sets the signature.
     *
     * @param string $signature
     * @return HeaderRequestBuilder
     */
    public function setSignature(string $signature): HeaderRequestBuilder
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Builds the HTTP request.
     *
     * @return Request
     */
    public function build(): Request
    {
        $body = [
            'challenge_type' => 'signup',
            'guid'           => $this->signature,
        ];

        return new Request(Client::METHOD_POST,
            $this->getUri(),
            $this->getHeaders(),
            $this->serializer()->encode($body));
    }

    /**
     * The request body serializer.
     *
     * @return SerializerInterface
     */
    protected function serializer(): SerializerInterface
    {
        return new UrlEncodedSerializer();
    }
}