<?php

namespace Instagram\SDK\Http\Traits;

use GuzzleHttp\Cookie\CookieJar;
use Instagram\SDK\DTO\CsrfToken;
use Instagram\SDK\DTO\Session\SessionId;

trait CookieMethodsTrait
{

    /**
     * Returns the cookie jar.
     *
     * @return CookieJar
     */
    abstract protected function getCookieJar(): CookieJar;

    /**
     * Returns the CSRF Token.
     *
     * @return CsrfToken
     */
    protected function getCsrfToken(): CsrfToken
    {
        return new CsrfToken($this->getCookieValue('csrftoken'));
    }

    /**
     * Returns the session id.
     *
     * @return SessionId
     */
    protected function getSessionId(): SessionId
    {
        return new SessionId($this->getCookieValue('sessionid'));
    }

    /**
     * Returns the cookie value.
     *
     * @param string $name
     * @return string|null
     */
    protected function getCookieValue($name): ?string
    {
        // Retrieve the cookie value by cookie name
        if (!$cookie = $this->client->getCookies()->getCookieByName($name)) {
            throw new Exception(sprintf('The cookie %s is missing in the cookie jar', $name));
        }

        return $cookie->getValue();
    }
}
