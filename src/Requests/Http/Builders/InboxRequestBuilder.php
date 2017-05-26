<?php

namespace NicklasW\Instagram\Requests\Http\Builders;

use GuzzleHttp\Psr7\Request;
use NicklasW\Instagram\HttpClients\Client;
use NicklasW\Instagram\Requests\Http\Marshallers\SerializerInterface;
use NicklasW\Instagram\Requests\Http\Marshallers\UrlEncodedSerializer;
use NicklasW\Instagram\Requests\Support\SignatureSupport;

class InboxRequestBuilder extends AbstractRequestBuilder
{

    /**
     * @var string The inbox request uri
     */
    protected const REQUEST_URI = 'direct_v2/inbox/';

    /**
     * Builds HTTP request.
     *
     * @return Request
     */
    public function build(): Request
    {
        return new Request(Client::METHOD_POST, $this->getUri(), $this->getHeaders());
    }

    /**
     * The request body serializer.
     *
     * @return SerializerInterface
     */
    protected function serializer(): ?SerializerInterface
    {
        return new UrlEncodedSerializer();
    }

}