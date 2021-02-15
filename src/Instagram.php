<?php

namespace Instagram\SDK;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Devices\Interfaces\DeviceBuilderInterface;
use Instagram\SDK\Requests\Traits\MakeRequestsAccessible;
use Instagram\SDK\Session\Session;

/**
 * Class Instagram
 *
 * @package Instagram\SDK
 */
class Instagram
{

    use MakeRequestsAccessible;

    /**
     * @var Client The Instagram API client
     */
    public $client;

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
     * @return static
     */
    public function setSession(Session $session)
    {
        $this->client->setSession($session);

        return $this;
    }

    /**
     * Sets the proxy uri.
     *
     * @param string $uri
     * @return self
     */
    public function setProxyUri(string $uri): self
    {
        $this->client->setProxyUri($uri);

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
