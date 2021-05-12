<?php

declare(strict_types=1);

namespace Instagram\SDK\Client\Features;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Device\DeviceInterface;
use Instagram\SDK\Request\Http\HttpClient;
use Instagram\SDK\Request\Request;
use Instagram\SDK\Response\Responses\ResponseEnvelope;
use Instagram\SDK\Session\Session;

/**
 * Trait DefaultFeaturesTrait
 *
 * @package Instagram\SDK\Client\Features
 * @phan-file-suppress ConstReferenceConstNotFound
 */
trait DefaultFeaturesTrait
{

    /** @var HttpClient */
    protected $client;

    /** @var Session */
    protected $session;

    /** @var DeviceInterface */
    protected $device;

    /**
     * Validate the {@link Session} for the logged in user.
     *
     * @throws Exception
     */
    abstract protected function checkSessionPrerequisites(): void;

    /**
     * Builds a {@link Request} instance.
     *
     * @param string           $uri
     * @param ResponseEnvelope $response
     * @param string           $method
     * @return Request
     * @link \Instagram\SDK\Client\Client::buildRequest
     */
    abstract protected function buildRequest(string $uri, ResponseEnvelope $response, string $method = 'POST'): Request;

    /**
     * Executes a request to the external API.
     *
     * @param Request $request
     * @return PromiseInterface
     * @link \Instagram\SDK\Client\Client::call
     */
    abstract protected function call(Request $request): PromiseInterface;

    /**
     * Adds a function to run in the task queue when it is next `run()` and returns
     * a promise that is fulfilled or rejected with the result.
     *
     * @param callable $callable
     * @return PromiseInterface
     */
    abstract protected function authenticated(callable $callable): PromiseInterface;
}
