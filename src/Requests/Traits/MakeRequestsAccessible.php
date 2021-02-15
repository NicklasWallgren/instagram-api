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
    use MakeAccountRequestAccessible;
    use MakeFeedRequestsAccessible;
    use MakeSearchRequestsAccessible;
    use MakeFriendshipsRequestsAccessible;
    use MakeMediaRequestsAccessible;
    use MakeUsersRequestAccessible;

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
