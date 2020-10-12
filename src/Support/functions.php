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
 * @param string   $uri     The request uri.
 * @param Envelope $message The envelope.
 * @param string   $method
 * @return Closure<GenericRequest>
 */
function request(string $uri, Envelope $message, string $method = 'POST'): Closure
{
    return function (Client $client, Session $session, HttpClient $httpClient) use ($uri, $message, $method): GenericRequest {
        return new GenericRequest(
            $session,
            $httpClient,
            new GenericRequestBuilder($uri, $method, $session),
            new GenericSerializer($client, $message)
        );
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
