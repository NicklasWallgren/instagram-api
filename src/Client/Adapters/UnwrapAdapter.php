<?php

namespace Instagram\SDK\Client\Adapters;

use Instagram\SDK\Client\Adapters\Interfaces\AdapterInterface;

/**
 * Class UnwrapAdapter
 *
 * @package Instagram\SDK\Client\Adapters
 */
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
