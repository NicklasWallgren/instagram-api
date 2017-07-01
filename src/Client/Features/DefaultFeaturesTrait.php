<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use Instagram\SDK\Client\Adapters\Interfaces\AdapterInterface;
use Instagram\SDK\Http\Client as HttpClient;
use Symfony\Component\HttpFoundation\Session\Session;

trait DefaultFeaturesTrait
{

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var HttpClient The Http client
     */
    protected $client;

    /**
     * @var Session
     */
    protected $session;

    /**
     * Validate the state.
     *
     * @throws Exception
     */
    abstract protected function checkPrerequisites();
}
