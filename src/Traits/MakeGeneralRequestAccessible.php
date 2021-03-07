<?php

declare(strict_types=1);

namespace Instagram\SDK\Traits;

use Instagram\SDK\Client\Client;

/**
 * Trait MakeGeneralRequestAccessible
 *
 * @package Instagram\SDK\Traits
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
