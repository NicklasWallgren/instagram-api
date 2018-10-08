<?php

namespace Instagram\SDK\Responses\Traits;

use Instagram\SDK\DTO\CsrfToken;
use Instagram\SDK\Responses\Exceptions\InvalidResponseException;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;

/**
 * Trait CsrfTokenRetrieverTrait
 *
 * @package Instagram\SDK\Responses\Traits
 */
trait CsrfTokenRetrieverTrait
{

    /**
     * @var string The cookie header key
     */
    protected static $KEY_HEADER_COOKIE = 'Set-Cookie';

    /**
     * Extracts the CSRF token from the headers.
     *
     * @param HttpResponseInterface $response
     * @return CsrfToken
     * @throws InvalidResponseException
     */
    protected function getCsrfToken(HttpResponseInterface $response): CsrfToken
    {
        $token = [];

        // Retrieve the cookie header value
        $header = $response->getHeaderLine(self::$KEY_HEADER_COOKIE);

        // Extract the CSRF token from the header
        if (!preg_match('/csrftoken=([^;]+)/', $header, $token)) {
            throw new InvalidResponseException('Invalid response. Couldn\'t retrieve CSRF token');
        }

        // @phan-suppress-next-line PhanPossiblyFalseTypeArgument
        return new CsrfToken(end($token));
    }
}
