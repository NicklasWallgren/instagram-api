<?php

namespace Instagram\SDK\Client\Adapters;

use GuzzleHttp\Promise\Promise;
use Instagram\SDK\Client\Adapters\Interfaces\AdapterInterface;
use function GuzzleHttp\Promise\task;

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
        return task($callback);
    }
}
