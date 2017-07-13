<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use Instagram\SDK\Client\Adapters\Interfaces\AdapterInterface;
use Instagram\SDK\Http\RequestClient;
use Instagram\SDK\Session\Session;

trait DefaultFeaturesTrait
{

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var RequestClient The request client
     */
    protected $client;

    /**
     * @var Session
     */
    protected $session;
 
    /**
     * @return bool
     */
    abstract protected function getMode():bool;

    /**
     * Validate the state.
     *
     * @throws Exception
     */
    abstract protected function checkPrerequisites();
}
