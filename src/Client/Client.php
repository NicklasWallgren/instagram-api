<?php

namespace NicklasW\Instagram\Client;

use Exception;
use GuzzleHttp\ClientInterface;
use NicklasW\Instagram\Client\Adapters\Interfaces\AdapterInterface;
use NicklasW\Instagram\Client\Adapters\UnwrapAdapter;
use NicklasW\Instagram\Client\Features\DirectFeaturesTrait;
use NicklasW\Instagram\Client\Features\DiscoverFeatures;
use NicklasW\Instagram\Client\Features\DiscoverFeaturesTrait;
use NicklasW\Instagram\Client\Features\GeneralFeaturesTrait;
use NicklasW\Instagram\Client\Features\UserFeaturesTrait;
use NicklasW\Instagram\Devices\Builders\DeviceBuilder;
use NicklasW\Instagram\Devices\Interfaces\DeviceBuilderInterface;
use NicklasW\Instagram\DTO\CsrfTokenMessage;
use NicklasW\Instagram\Http\Client as HttpClient;
use NicklasW\Instagram\Session\Session;

class Client
{

    use DiscoverFeaturesTrait;
    use GeneralFeaturesTrait;
    use UserFeaturesTrait;
    use DirectFeaturesTrait;

    /**
     * @var HttpClient The Http client
     */
    protected $client;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var DeviceBuilderInterface
     */
    protected $builder;

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * Client constructor.
     *
     * @param ClientInterface        $client
     * @param DeviceBuilderInterface $builder
     * @param AdapterInterface|null  $adapter
     */
    public function __construct(
        ?ClientInterface $client = null,
        ?DeviceBuilderInterface $builder = null,
        ?AdapterInterface $adapter = null
    ) {
        $this->client = new HttpClient($client);
        $this->builder = $builder ?: new DeviceBuilder();
        $this->adapter = $adapter ?: new UnwrapAdapter();
    }

    /**
     * Returns the current session.
     *
     * @return Session
     */
    public function getSession(): ?Session
    {
        return $this->session;
    }

    /**
     * Sets the current session.
     *
     * @param Session $session
     */
    public function setSession(Session $session)
    {
        $this->session = $session;

        $this->client->setCookies($session->getCookies());
    }

    /**
     * Sets the adapter.
     *
     * @param AdapterInterface $adapter
     */
    public function setAdapter(AdapterInterface $adapter): void
    {
        $this->adapter = $adapter;
    }

    /**
     * @return AdapterInterface
     */
    public function getAdapter(): AdapterInterface
    {
        return $this->adapter;
    }

    /**
     * Validate the state.
     *
     * @throws Exception
     */
    protected function checkPrerequisites()
    {
        // Check whether the user is authenticated or not
        if (!$this->isSessionAvailable()) {
            throw new Exception('Session is missing. Please log in.');
        }
    }

    /**
     * Returns true if session is available, false otherwise.
     *
     * @return bool
     */
    protected function isSessionAvailable(): bool
    {
        return $this->session !== null;
    }

}