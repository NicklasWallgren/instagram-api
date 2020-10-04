<?php

namespace Instagram\SDK\Client\Adapters;

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\Utils;
use Instagram\SDK\Client\Adapters\Interfaces\AdapterInterface;

/**
 * Class PromiseAdapter
 *
 * @package Instagram\SDK\Client\Adapters
 */
class PromiseAdapter implements AdapterInterface
{

    /**
     * Client adapter.
     *
     * @param callable $callback
     * @return Promise
     */
    public function run(callable $callback): Promise
    {
        return Utils::task($callback);
    }
}
