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
     * @var bool The promise mode flag
     */
    public const MODE_PROMISE = false;

    /**
     * @var bool The unwrap mode flag
     */
    public const MODE_UNWRAP = true;

    /**
     * @var Client The Instagram API client
     */
    protected $client;

    /**
     * Instagram constructor.
     *
     * @param DeviceBuilderInterface|null $builder
     */
    public function __construct(?DeviceBuilderInterface $builder = null)
    {
        $this->client = new Client($builder);
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
     * Sets the result mode.
     *
     * @param bool $mode
     * @return self
     */
    public function setMode(bool $mode): self
    {
        $this->client->setMode($mode);

        return $this;
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
