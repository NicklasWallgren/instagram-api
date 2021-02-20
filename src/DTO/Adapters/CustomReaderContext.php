<?php

namespace Instagram\SDK\DTO\Adapters;

use Instagram\SDK\Client\Client;
use Tebru\Gson\Context\ReaderContext;

final class CustomReaderContext extends ReaderContext
{

    /**
     * @var Client
     */
    private $client;

    /**
     * CustomReaderContext constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

}