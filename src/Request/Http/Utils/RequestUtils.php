<?php

declare(strict_types=1);

namespace Instagram\SDK\Request\Http\Utils;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

/**
 * Class RequestUtils
 *
 * @package Instagram\SDK\Request\Http\Utils
 */
final class RequestUtils
{
    /**
     * Returns the method uri.
     *
     * @param string               $host
     * @param string               $path
     * @param array<string, mixed> $queryParameters
     * @return UriInterface
     */
    public static function createUri(string $host, string $path, array $queryParameters = []): UriInterface
    {
        $uri = new Uri();

        return $uri->withHost($host)
            ->withPath('/api/v1/' . $path)
            ->withScheme('https')
            ->withQuery(self::createQuery($queryParameters));
    }

    /**
     * @param array<string, mixed> $queryParameters
     * @return string
     */
    private static function createQuery(array $queryParameters): string
    {
        if (($parameters = http_build_query($queryParameters, '', '&')) == null) {
            return '';
        }

        return $parameters;
    }

    /**
     * RequestUtils constructor.
     */
    private function __construct()
    {
    }
}
