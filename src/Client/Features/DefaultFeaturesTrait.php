<?php

namespace Instagram\SDK\Client\Features;

use Exception;
use Instagram\SDK\Client\Adapters\Interfaces\AdapterInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Devices\Interfaces\DeviceBuilderInterface;
use Instagram\SDK\Http\RequestClient;
use Instagram\SDK\Session\Session;

/**
 * Trait DefaultFeaturesTrait
 *
 * @package Instagram\SDK\Client\Features
 */
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
     * @var DeviceBuilderInterface
     */
    protected $builder;

    /**
     * @var bool The result mode
     */
    protected $mode = true;

    /**
     * @return bool
     */
    abstract protected function getMode(): bool;

    /**
     * Validate the state.
     *
     * @throws Exception
     */
    abstract protected function checkPrerequisites(): void;

    /**
     * Returns the subject instance.
     *
     * @return Client
     */
    abstract protected function getSubject(): Client;
}
