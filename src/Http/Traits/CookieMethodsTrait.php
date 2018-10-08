<?php

namespace Instagram\SDK\Http\Traits;

use Exception;
use GuzzleHttp\Cookie\CookieJar;
use Instagram\SDK\DTO\CsrfToken;
use Instagram\SDK\DTO\Session\SessionId;

/**
 * Trait CookieMethodsTrait
 *
 * @package Instagram\SDK\Http\Traits
 */
trait CookieMethodsTrait
{

    /**
     * Returns the CSRF Token.
     *
     * @return CsrfToken
     * @throws Exception
     */
    public function getCsrfToken(): CsrfToken
    {
        return new CsrfToken($this->getCookieValue('csrftoken'));
    }

    /**
     * Returns the session id.
     *
     * @return SessionId
     * @throws Exception
     */
    public function getSessionId(): SessionId
    {
        return new SessionId($this->getCookieValue('sessionid'));
    }

    /**
     * Returns the cookie value.
     *
     * @param string $name
     * @return string
     * @throws Exception
     */
    public function getCookieValue($name): string
    {
        // Retrieve the cookie value by cookie name
        if (!$cookie = $this->getCookieJar()->getCookieByName($name)) {
            throw new Exception(sprintf('The cookie %s is missing in the cookie jar', $name));
        }

        return $cookie->getValue();
    }

    /**
     * Returns the cookie jar.
     *
     * @return CookieJar
     */
    abstract protected function getCookieJar(): CookieJar;
}
