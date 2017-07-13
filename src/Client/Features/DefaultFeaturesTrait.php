<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use Instagram\SDK\Client\Adapters\Interfaces\AdapterInterface;
use Instagram\SDK\Http\RequestClient as HttpClient;
use Instagram\SDK\Instagram;
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
     * @var bool
     */
    protected $mode = Instagram::MODE_UNWRAP;

    /**
     * Validate the state.
     *
     * @throws Exception
     */
    abstract protected function checkPrerequisites();
}
