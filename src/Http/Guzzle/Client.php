<?php

namespace Instagram\SDK\Http\Guzzle;

use Guzzle\Http\Message\RequestInterface;
use GuzzleHttp\Promise\PromiseInterface;
use function Instagram\SDK\Support\promise_for;
use function Instagram\SDK\Support\rejection_for;

class Client extends \GuzzleHttp\Client
{

    /**
     * Transfers the given request and applies request options.
     * The URI of the request is not modified and the request options are used
     * as-is without merging in default options.
     *
     * @param RequestInterface $request
     * @param array            $options
     * @return PromiseInterface
     */
    private function transfer(RequestInterface $request, array $options)
    {
        // save_to -> sink
        if (isset($options['save_to'])) {
            $options['sink'] = $options['save_to'];
            unset($options['save_to']);
        }

        // exceptions -> http_errors
        if (isset($options['exceptions'])) {
            $options['http_errors'] = $options['exceptions'];
            unset($options['exceptions']);
        }

        $request = $this->applyOptions($request, $options);
        $handler = $options['handler'];

        try {
            return promise_for($handler($request, $options));
        } catch (\Exception $e) {
            return rejection_for($e);
        }
    }
}
