<?php

namespace NicklasW\Instagram\Responses\Traits;

use NicklasW\Instagram\DTO\CsrfTokenMessage;
use NicklasW\Instagram\DTO\Session\SessionId;
use NicklasW\Instagram\Responses\Exceptions\ApiResponseException;
use NicklasW\Instagram\Responses\Exceptions\InvalidResponseException;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

trait SessionIdRetrieverTrait
{

    /**
     * @var string The cookie header key
     */
    protected static $KEY_HEADER_COOKIE = 'Set-Cookie';

    /**
     * Extracts the session id from the headers.
     *
     * @param HttpResponseInterface $response
     * @return SessionId
     * @throws InvalidResponseException
     */
    protected function getSessionId(HttpResponseInterface $response): SessionId
    {
        $token = [];

        // Retrieve the cookie header value
        $header = $response->getHeaderLine(self::$KEY_HEADER_COOKIE);

        // Extract the session id from the header
        if (!preg_match('/sessionid=([^;]+)/', $header, $token)) {
            throw new InvalidResponseException('Invalid response. Couldn\'t retrieve session id');
        }

        return new SessionId(end($token));
    }

}