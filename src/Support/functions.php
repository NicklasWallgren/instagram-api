<?php

namespace Instagram\SDK\Support;

use Closure;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Http\RequestClient as HttpClient;
use Instagram\SDK\Requests\GenericRequest;
use Instagram\SDK\Requests\Http\Builders\AbstractRequestBuilder;
use Instagram\SDK\Requests\Http\Builders\GenericRequestBuilder;
use Instagram\SDK\Requests\Support\SignatureSupport;
use Instagram\SDK\Responses\Serializers\AbstractSerializer;
use Instagram\SDK\Responses\Serializers\GenericSerializer;
use Instagram\SDK\Session\Session;

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
 * Generates a generic request instance.
 *
 * @param string|AbstractRequestBuilder $uri        The request uri or request builder
 * @param Envelope|AbstractSerializer   $serializer The response envelope or serializer
 * @return Closure
 */
function request($uri, $serializer)
{
    return function (Client $client, Session $session, HttpClient $httpClient) use ($uri, $serializer): GenericRequest {
        // Check whether uri corresponds to a request builder
        if (!($uri instanceof GenericRequestBuilder)) {
            $uri = new GenericRequestBuilder($uri, $session);
        }

        // Check whether serializer corresponds to a abstract serializer
        if (!($serializer instanceof AbstractSerializer)) {
            $serializer = new GenericSerializer($client, $serializer);
        }

        return new GenericRequest($session, $httpClient, $uri, $serializer);
    };
}

/**
 * Returns the camel cased string as underscore case.
 *
 * @param string $target
 * @return string
 */
function underscore(string $target): string
{
    return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $target));
}

/**
 * Returns the double as a string.
 *
 * @param float $subject
 * @return string
 */
function floatAsString(float $subject): string
{
    return number_format($subject, 0, '', '');
}
