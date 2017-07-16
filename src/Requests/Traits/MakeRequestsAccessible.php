<?php

namespace Instagram\SDK\Requests\Traits;

use Instagram\SDK\Client\Client;

trait MakeRequestsAccessible
{

    use MakeGeneralRequestAccessible;
    use MakeDirectRequestAccessible;
    use MakeDiscoverRequestAccessible;
    use MakeUserRequestAccessible;

    /**
     * Returns the result mode.
     *
     * @return bool
     */
    protected function getMode(): bool
    {
        return $this->getClient()->getMode();
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
