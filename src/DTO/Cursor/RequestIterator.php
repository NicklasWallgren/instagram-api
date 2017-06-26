<?php

namespace NicklasW\Instagram\DTO\Cursor;

use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\Requests\Traits\MakeRequestsAccessible;
use NicklasW\Instagram\Responses\Interfaces\IteratorInterface;

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