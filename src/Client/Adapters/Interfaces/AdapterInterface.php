<?php

namespace NicklasW\Instagram\Client\Adapters\Interfaces;

interface AdapterInterface
{

    /**
     * Execute the callable.
     *
     * @param callable $callback
     */
    public function run(callable $callback);
}
