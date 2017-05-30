<?php

namespace NicklasW\Instagram\Client\Adapters;

use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\Client\Adapters\Interfaces\AdapterInterface;
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