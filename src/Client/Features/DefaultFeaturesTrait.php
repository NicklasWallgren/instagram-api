<?php

namespace NicklasW\Instagram\Client\Features;

use Exception;
use NicklasW\Instagram\Client\Adapters\Interfaces\AdapterInterface;
use NicklasW\Instagram\Http\Client as HttpClient;
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