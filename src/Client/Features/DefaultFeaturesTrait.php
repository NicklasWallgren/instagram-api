<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Devices\Interfaces\DeviceBuilderInterface;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Http\HttpClient;
use Instagram\SDK\Requests\Request;
use Instagram\SDK\Session\Session;

/**
 * Trait DefaultFeaturesTrait
 *
 * @package Instagram\SDK\Client\Features
 */
trait DefaultFeaturesTrait
{

    /**
     * @var HttpClient The request client
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

    /**
     * Builds a request.
     *
     * @param string   $uri
     * @param Envelope $message
     * @param string   $method
     * @return Request
     */
    abstract protected function buildRequest(string $uri, Envelope $message, string $method = 'POST'): Request;

    /**
     * Executes a request to the external API.
     *
     * @param Request $request
     * @return PromiseInterface
     */
    abstract protected function call(Request $request): PromiseInterface;

}
