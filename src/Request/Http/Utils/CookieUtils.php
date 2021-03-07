<?php

declare(strict_types=1);

namespace Instagram\SDK\Request\Http\Utils;

use GuzzleHttp\Cookie\CookieJar;
use Instagram\SDK\Exceptions\InstagramException;

/**
 * Class CookieUtils
 *
 * @package Instagram\SDK\Request\Http\Utils
 */
class CookieUtils
{

    /**
     * Returns the cookie value.
     *
     * @param string    $field
     * @param CookieJar $cookieJar
     * @return string
     * @throws InstagramException
     */
    public static function getCookieValue(string $field, CookieJar $cookieJar): string
    {
        if (($cookie = $cookieJar->getCookieByName($field)) === null) {
            throw new InstagramException(sprintf('The cookie %s is missing in the cookie jar', $field));
        }

        return $cookie->getValue();
    }
}
