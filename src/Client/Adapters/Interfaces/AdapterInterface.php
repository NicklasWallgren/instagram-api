<?php

namespace Instagram\SDK\Client\Adapters\Interfaces;

/**
 * Interface AdapterInterface
 *
 * @package Instagram\SDK\Client\Adapters\Interfaces
 */
interface AdapterInterface
{

    /**
     * Execute the callable.
     *
     * @param callable $callback
     * @return mixed
     */
    public function run(callable $callback);
}
