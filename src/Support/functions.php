<?php

namespace NicklasW\Instagram\Support;

use Closure;
use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\DTO\Envelope;
use NicklasW\Instagram\HttpClients\Client as HttpClient;
use NicklasW\Instagram\Requests\GenericRequest;
use NicklasW\Instagram\Requests\Http\Builders\AbstractRequestBuilder;
use NicklasW\Instagram\Requests\Http\Builders\GenericRequestBuilder;
use NicklasW\Instagram\Requests\Support\SignatureSupport;
use NicklasW\Instagram\Responses\Serializers\AbstractSerializer;
use NicklasW\Instagram\Responses\Serializers\GenericSerializer;
use NicklasW\Instagram\Session\Session;

/**
 * Generates a universal unique identifier.
 *
 * @param bool $type The identifier type
 * @return string
 */
function uuid(bool $type = SignatureSupport::TYPE_DEFAULT): string
{
    return SignatureSupport::uuid($type);
}

/**
 * Unwrap promise.
 *
 * @param Promise|mixed $value
 * @return mixed
 */
function unwrap($value)
{
    return $value instanceof Promise ? $value->wait() : $value;
}

/**
 * Generates a generic request instance.
 *
 * @param string|AbstractRequestBuilder $uri The request uri or request builder
 * @param Envelope|AbstractSerializer   $serializer The response envelope or serializer
 * @return Closure
 */
function request($uri, $serializer)
{
    return function (Client $client, Session $session, HttpClient $httpClient) use ($uri, $serializer) {
        // Check whether uri corresponds to a request builder
        if (!($uri instanceof AbstractRequestBuilder)) {
            $uri = new GenericRequestBuilder($uri, $session);
        }

        // Check whether serializer corresponds to a abstract serializer
        if (!($serializer instanceof AbstractSerializer)) {
            $serializer = new GenericSerializer($client, $serializer);
        }

        return new GenericRequest($session, $httpClient, $uri, $serializer);
    };
}



