<?php

namespace Instagram\SDK\Client;

use Exception;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Features\AccountFeaturesTrait;
use Instagram\SDK\Client\Features\DirectFeaturesTrait;
use Instagram\SDK\Client\Features\DiscoverFeaturesTrait;
use Instagram\SDK\Client\Features\FeedFeaturesTrait;
use Instagram\SDK\Client\Features\FriendshipsFeaturesTrait;
use Instagram\SDK\Client\Features\GeneralFeaturesTrait;
use Instagram\SDK\Client\Features\MediaFeaturesTrait;
use Instagram\SDK\Client\Features\SearchFeaturesTrait;
use Instagram\SDK\Client\Features\UsersFeaturesTrait;
use Instagram\SDK\Devices\Builders\DeviceBuilder;
use Instagram\SDK\Devices\Interfaces\DeviceBuilderInterface;
use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\DTO\Interfaces\ResponseMessageInterface;
use Instagram\SDK\Http\HttpClient;
use Instagram\SDK\Requests\Exceptions\EncodingException;
use Instagram\SDK\Requests\Http\Builders\RequestBuilder;
use Instagram\SDK\Requests\Request;
use Instagram\SDK\Responses\Interfaces\SerializerInterface;
use Instagram\SDK\Responses\Serializers\Serializer;
use Instagram\SDK\Session\Session;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use Throwable;
use function GuzzleHttp\Promise\rejection_for;
use function GuzzleHttp\Promise\task;

/**
 * Class Client
 *
 * @package Instagram\SDK\Client
 */
class Client
{

    use DiscoverFeaturesTrait;
    use GeneralFeaturesTrait;
    use AccountFeaturesTrait;
    use DirectFeaturesTrait;
    use SearchFeaturesTrait;
    use FeedFeaturesTrait;
    use FriendshipsFeaturesTrait;
    use MediaFeaturesTrait;
    use UsersFeaturesTrait;

    /** @var HttpClient */
    protected $client;

    /** @var Session */
    protected $session;

    /** @var DeviceBuilderInterface */
    protected $builder;

    /**
     * Client constructor.
     *
     * @param DeviceBuilderInterface|null $builder
     */
    public function __construct(?DeviceBuilderInterface $builder = null)
    {
        $this->client = new HttpClient();
        $this->builder = $builder ?: new DeviceBuilder();
    }

    /**
     * Returns the current session.
     *
     * @return Session|null
     */
    public function getSession(): ?Session
    {
        return $this->session;
    }

    /**
     * Sets the current session.
     *
     * @param Session $session
     * @return self
     */
    public function setSession(Session $session): self
    {
        $this->session = $session;

        $this->client->setCookies($session->getCookies());

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
        $this->client->getConfiguration()->addProxyUri($uri);

        return $this;
    }

    /**
     * Validate the state.
     *
     * @return void
     * @throws Exception
     */
    protected function checkPrerequisites(): void
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

    /**
     * Fire the request.
     *
     * @param Request $request
     * @return PromiseInterface
     * @suppress PhanThrowTypeAbsentForCall
     */
    protected function call(Request $request): PromiseInterface
    {
        $result = null;

        try {
            $result = $request->toHttpRequest();
        } catch (EncodingException $e) {
            return rejection_for($e->getMessage());
        }

        return $this->doRequest($result, $request->getSerializer());
    }

    /**
     * Builds a {@link doRequest} instance for the provided parameters.
     *
     * @param string   $uri
     * @param Envelope $message
     * @param string   $method
     * @return Request
     */
    protected function buildRequest(string $uri, Envelope $message, string $method = 'POST'): Request
    {
        return new Request(
            new RequestBuilder($uri, $method, $this->session),
            new Serializer($this, $message)
        );
    }

    /**
     * Builds a {@link Request} instance for the provided parameters.
     *
     * @param string              $uri
     * @param Envelope            $message
     * @param SerializerInterface $serializer
     * @param string              $method
     * @return Request
     */
    // phpcs:ignore
    protected function buildRequestWithSerializer(string $uri, Envelope $message, SerializerInterface $serializer, string $method = 'POST'): Request
    {
        return new Request(
            new RequestBuilder($uri, $method, $this->session),
            $serializer
        );
    }

    /**
     * Executes an asynchronous request.
     *
     * @param RequestInterface    $request
     * @param SerializerInterface $serializer
     * @return PromiseInterface
     */
    protected function doRequest(RequestInterface $request, SerializerInterface $serializer): PromiseInterface
    {
        // Execute the asynchronous request
        $promise = $this->client->requestAsync($request);

        // Return a promise chain
        return $promise->then(function (HttpResponseInterface $response) use ($serializer): PromiseInterface {
            return $this->decode($response, $serializer);
        })->otherwise(function (Throwable $exception) use ($serializer): PromiseInterface {
            if (!self::isRequestException($exception)) {
                return Create::rejectionFor($exception);
            }

            // @phan-suppress-next-line PhanUndeclaredMethod
            return $this->decode($exception->getResponse(), $serializer);
        });
    }

    /**
     * Decode the response.
     *
     * @param HttpResponseInterface $response
     * @param SerializerInterface   $serializer
     * @return PromiseInterface
     */
    private function decode(HttpResponseInterface $response, SerializerInterface $serializer)
    {
        return task(function () use ($response, $serializer): ResponseMessageInterface {
            return $serializer->decode($response, $this);
        });
    }

    /**
     * Returns true if the exception is of request exception, false otherwise.
     *
     * @param Throwable $exception
     * @return bool
     */
    private static function isRequestException(Throwable $exception): bool
    {
        return $exception instanceof RequestException;
    }

    /**
     * @inheritDoc
     */
    public function __debugInfo()
    {
        return [];
    }
}
