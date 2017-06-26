<?php

namespace NicklasW\Instagram\Requests\Traits;

use NicklasW\Instagram\Client\Client;

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
