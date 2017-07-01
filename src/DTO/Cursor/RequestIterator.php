<?php

namespace Instagram\SDK\DTO\Cursor;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Requests\Traits\MakeRequestsAccessible;
use Instagram\SDK\Responses\Interfaces\IteratorInterface;

abstract class RequestIterator implements IteratorInterface
{

    use MakeRequestsAccessible;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Iterator constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

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
