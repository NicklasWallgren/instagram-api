<?php

namespace Instagram\SDK\DTO\Cursor;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Responses\Interfaces\IteratorInterface;

/**
 * Class RequestIterator
 *
 * @package Instagram\SDK\DTO\Cursor
 */
abstract class RequestIterator extends Envelope implements IteratorInterface
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
