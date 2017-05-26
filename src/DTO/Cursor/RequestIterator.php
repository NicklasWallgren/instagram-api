<?php

namespace NicklasW\Instagram\DTO\Cursor;

use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\Requests\Traits\MakeRequestsAccessable;
use NicklasW\Instagram\Responses\Interfaces\IteratorInterface;

abstract class RequestIterator implements IteratorInterface
{

    use MakeRequestsAccessable;

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