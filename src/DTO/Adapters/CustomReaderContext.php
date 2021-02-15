<?php

namespace Instagram\SDK\DTO\Adapters;

use Instagram\SDK\Client\Client;
use Tebru\Gson\Context\ReaderContext;

class CustomReaderContext extends ReaderContext
{

    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     * @return static
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
        return $this;
    }

}