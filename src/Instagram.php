<?php

namespace Instagram\SDK;

use GuzzleHttp\ClientInterface;
use Instagram\SDK\Client\Adapters\Interfaces\AdapterInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Devices\DeviceBuilderInterface;
use Instagram\SDK\Requests\Traits\MakeRequestsAccessible;
use Instagram\SDK\Session\Session;

class Instagram
{

    use MakeRequestsAccessible;

    /**
     * @var Client The Instagram API client
     */
    protected $client;

    /**
     * @var ClientInterface|null
     */
    protected $httpClient;

    /**
     * Instagram constructor.
     *
     * @param ClientInterface|null        $httpClient
     * @param DeviceBuilderInterface|null $builder
     * @param AdapterInterface|null       $adapter
     */
    public function __construct(
        ?ClientInterface $httpClient = null,
        ?DeviceBuilderInterface $builder = null,
        ?AdapterInterface $adapter = null
    ) {
        $this->client = new Client($httpClient, $builder, $adapter);
        $this->httpClient = $httpClient;
    }

    /**
     * Sets the current session.
     *
     * @param Session $session
     */
    public function setSession(Session $session)
    {
        $this->client->setSession($session);
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
