<?php

namespace NicklasW\Instagram;

use GuzzleHttp\ClientInterface;
use NicklasW\Instagram\Client\Adapters\Interfaces\AdapterInterface;
use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\Devices\DeviceBuilderInterface;
use NicklasW\Instagram\Requests\Traits\MakeRequestsAccessable;
use NicklasW\Instagram\Session\Session;

class Instagram
{

    use MakeRequestsAccessable;

    /**
     * @var Client The Instagram API client
     */
    protected $client;

    /**
     * @var ClientInterface|null
     */
    private $httpClient;

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