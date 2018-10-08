<?php

namespace Instagram\SDK\Responses\Traits;

use Instagram\SDK\DTO\Session\SessionId;
use Instagram\SDK\Responses\Exceptions\InvalidResponseException;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

/**
 * Trait SessionIdRetrieverTrait
 *
 * @package Instagram\SDK\Responses\Traits
 */
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

        // @phan-suppress-next-line PhanPossiblyFalseTypeArgument
        return new SessionId(end($token));
    }
}
