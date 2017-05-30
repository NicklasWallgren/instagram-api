<?php

namespace NicklasW\Instagram\Client\Adapters;

use NicklasW\Instagram\Client\Adapters\Interfaces\AdapterInterface;

class UnwrapAdapter implements AdapterInterface
{

    /**
     * Client adapter.
     *
     * @param callable $callback
     * @return mixed
     */
    public function run(callable $callback)
    {
        // Execute the callback
        $promise = $callback();

        return $promise->wait();
    }

}