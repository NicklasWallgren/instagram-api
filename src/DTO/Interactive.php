<?php

namespace Instagram\SDK\DTO;

use Instagram\SDK\Client\Client;

/**
 * Class Interactive
 *
 * @package Instagram\SDK\DTO
 */
abstract class Interactive extends DTO
{

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
