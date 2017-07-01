<?php

namespace Instagram\SDK\Requests\Traits;

use Instagram\SDK\Client\Client;

trait MakeRequestsAccessible
{

    use MakeGeneralRequestAccessible;
    use MakeDirectRequestAccessible;
    use MakeDiscoverRequestAccessible;

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
