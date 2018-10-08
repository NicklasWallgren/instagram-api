<?php

namespace Instagram\SDK\Requests\Traits;

use Instagram\SDK\Client\Client;

/**
 * Trait MakeGeneralRequestAccessible
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait MakeGeneralRequestAccessible
{

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
