<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO;

use Instagram\SDK\Client\Client;

/**
 * Class Interactive
 *
 * @package Instagram\SDK\Payloads
 */
abstract class Interactive extends DTO
{

    /** @var Client */
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
