<?php

namespace Instagram\SDK\Http\Handlers;

use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Handler\Proxy;
use GuzzleHttp\Handler\StreamHandler;
use GuzzleHttp\Middleware;
use RuntimeException;

class HandlerStack extends \GuzzleHttp\HandlerStack
{

    /**
     * Creates a default handler stack that can be used by clients.
     * The returned handler will wrap the provided handler or use the most
     * appropriate default handler for you system. The returned HandlerStack has
     * support for cookies, redirects, HTTP error exceptions, and preparing a body
     * before sending.
     * The returned handler stack can be passed to a client in the "handler"
     * option.
     *
     * @param callable $handler HTTP handler function to use with the stack. If no
     *                          handler is provided, the best handler for your
     *                          system will be utilized.
     * @return HandlerStack
     */
    public static function create(callable $handler = null)
    {
        $stack = new self(static::createHandler());
        $stack->push(Middleware::httpErrors(), 'http_errors');
        $stack->push(Middleware::redirect(), 'allow_redirects');
        $stack->push(Middleware::cookies(), 'cookies');
        $stack->push(Middleware::prepareBody(), 'prepare_body');

        return $stack;
    }

    /**
     * Chooses and creates a default handler to use based on the environment.
     *
     * The returned handler is not wrapped by any default middlewares.
     *
     * @throws RuntimeException if no viable Handler is available.
     * @return callable Returns the best handler for the given system.
     */
    protected static function createHandler()
    {

        // CurlFactory, \GuzzleHttp\Promise\rejection_for($error);
        // CurlMultiHandler, new \Instagram\SDK\Support\Promise(


        $handler = null;
        if (function_exists('curl_multi_exec') && function_exists('curl_exec')) {
            $handler = Proxy::wrapSync(new CurlMultiHandler(), new CurlHandler());
        } elseif (function_exists('curl_exec')) {
            $handler = new CurlHandler();
        } elseif (function_exists('curl_multi_exec')) {
            $handler = new CurlMultiHandler();
        }

        if (ini_get('allow_url_fopen')) {
            $handler = $handler
                ? Proxy::wrapStreaming($handler, new StreamHandler())
                : new StreamHandler();
        } elseif (!$handler) {
            throw new RuntimeException('GuzzleHttp requires cURL, the '
                . 'allow_url_fopen ini setting, or a custom HTTP handler.');
        }

        return $handler;
    }
}
