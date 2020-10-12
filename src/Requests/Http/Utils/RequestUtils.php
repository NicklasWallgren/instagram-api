<?php

namespace Instagram\SDK\Requests\Http\Utils;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;

/**
 * Class RequestUtils
 *
 * @package Instagram\SDK\Requests\Http\Utils
 */
class RequestUtils
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
            ->withPath('api/v1/' . $path)
            ->withScheme('https')
            ->withQuery(self::createQuery($queryParameters));
    }

    /**
     * @param string               $template
     * @param array<string, mixed> $parameters
     * @return string
     */
    public static function createPath(string $template, array $parameters = []): string
    {
        // @phan-suppress-next-line PhanPluginPrintfVariableFormatString, PhanTypeMismatchUnpackKey
        return sprintf($template, ...$parameters);
    }

    /**
     * @param array<string, mixed> $queryParameters
     * @return string
     */
    public static function createQuery(array $queryParameters): string
    {
        if (($parameters = http_build_query($queryParameters, '', '&')) == null) {
            return '';
        }

        return $parameters;
    }
}
