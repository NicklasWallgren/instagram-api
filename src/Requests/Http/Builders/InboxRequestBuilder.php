<?php

namespace NicklasW\Instagram\Requests\Http\Builders;

use GuzzleHttp\Psr7\Request;
use NicklasW\Instagram\HttpClients\Client;
use NicklasW\Instagram\Requests\Http\Marshallers\SerializerInterface;
use NicklasW\Instagram\Requests\Http\Marshallers\UrlEncodedSerializer;
use NicklasW\Instagram\Requests\Http\Traits\RequestBuilderQueryMethodsTrait;
use NicklasW\Instagram\Requests\Support\SignatureSupport;
use NicklasW\Instagram\Requests\Traits\RequestBuilderMethodsTrait;

class InboxRequestBuilder extends AbstractQueryRequestBuilder
{

    /**
     * @var string The inbox request uri
     */
    protected static $REQUEST_URI = 'direct_v2/inbox/';

}