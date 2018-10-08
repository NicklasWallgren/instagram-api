<?php

namespace Instagram\SDK\DTO;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Requests\Traits\MakeRequestsAccessible;

/**
 * Class Interactive
 *
 * @package Instagram\SDK\DTO
 */
abstract class Interactive
{

    use MakeRequestsAccessible;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Returns the client.
     *
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }
}
