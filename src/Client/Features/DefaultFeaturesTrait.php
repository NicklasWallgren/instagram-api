<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use Exception;
use Instagram\SDK\Client\Adapters\Interfaces\AdapterInterface;
use Instagram\SDK\Devices\Interfaces\DeviceBuilderInterface;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Http\RequestClient;
use Instagram\SDK\Requests\GenericRequest;
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
     * Validate the state.
     *
     * @throws Exception
     */
    abstract protected function checkPrerequisites(): void;

    abstract protected function request(string $uri, Envelope $message, string $method = 'POST'): GenericRequest;
}
