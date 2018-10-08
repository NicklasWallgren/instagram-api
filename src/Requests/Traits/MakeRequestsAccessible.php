<?php

namespace Instagram\SDK\Requests\Traits;

use Instagram\SDK\Client\Client;

/**
 * Trait MakeRequestsAccessible
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait MakeRequestsAccessible
{

    use MakeGeneralRequestAccessible;
    use MakeDirectRequestAccessible;
    use MakeDiscoverRequestAccessible;
    use MakeUserRequestAccessible;
    use MakeFeedRequestsAccessible;
    use MakeSearchRequestsAccessible;

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
