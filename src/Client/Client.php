<?php

declare(strict_types=1);

namespace Instagram\SDK\Client;

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
use Instagram\SDK\Device\Builders\DeviceBuilder;
use Instagram\SDK\Device\DeviceBuilderInterface;
use Instagram\SDK\Device\DeviceInterface;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Exceptions\NotAuthenticatedException;
use Instagram\SDK\Request\Http\Builders\RequestBuilder;
use Instagram\SDK\Request\Http\HttpClient;
use Instagram\SDK\Request\Http\HttpClientConfiguration;
use Instagram\SDK\Request\Request;
use Instagram\SDK\Response\Interfaces\ResponseSerializerInterface;
use Instagram\SDK\Response\Responses\ResponseEnvelope;
use Instagram\SDK\Response\Responses\ResponseInterface;
use Instagram\SDK\Response\Serializers\ResponseSerializer;
use Instagram\SDK\Session\Session;
use Instagram\SDK\Utils\PromiseUtils;
use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use Throwable;

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

    /** @var Session|null */
    protected $session;

    /** @var DeviceInterface */
    protected $device;

    /**
     * Client constructor.
     *
     * @param DeviceBuilderInterface|null $builder
     * @param Session|null                $session
     * @param string|null                 $proxyUri
     */
    public function __construct(?DeviceBuilderInterface $builder, ?Session $session, ?string $proxyUri)
    {
        $this->client = new HttpClient($session ? $session->getCookies() : null, new HttpClientConfiguration($proxyUri));
        $this->device = $builder ? $builder->build() : DeviceBuilder::builder()->build();
        $this->session = $session;
    }

    /**
     * Executes the request.
     *
     * @param Request $request
     * @return PromiseInterface<ResponseEnvelope|InstagramException>
     * @suppress PhanThrowTypeAbsentForCall
     */
    protected function call(Request $request): PromiseInterface
    {
        $httpRequest = null;

        try {
            $httpRequest = $request->toHttpRequest();
        } catch (Throwable $e) {
            // @phan-suppress-next-line PhanDeprecatedFunction
            return Create::rejectionFor($e->getMessage());
        }

        return $this->doRequest($httpRequest, $request->getSerializer());
    }

    /**
     * Builds a {@link Request} instance for the provided parameters.
     *
     * @param string           $uri
     * @param ResponseEnvelope $response
     * @param string           $method
     * @return Request
     * @throws InvalidArgumentException
     */
    protected function buildRequest(string $uri, ResponseEnvelope $response, string $method = 'POST'): Request
    {
        return new Request(
            new RequestBuilder($uri, $method, $this->device),
            new ResponseSerializer($this, $response)
        );
    }

    /**
     * @inheritDoc
     * @throws NotAuthenticatedException
     */
    protected function checkSessionPrerequisites(): void
    {
        // Check whether the user is authenticated or not
        if (!$this->isSessionAvailable()) {
            throw new NotAuthenticatedException('User not authenticated. Please log in.');
        }
    }

    /**
     * Authenticated task.
     *
     * @param callable $callable
     * @return PromiseInterface<ResponseEnvelope|NotAuthenticatedException>
     */
    protected function authenticated(callable $callable): PromiseInterface
    {
        return PromiseUtils::task(function () use ($callable): PromiseInterface {
            // @phan-suppress-next-line PhanThrowTypeAbsentForCall
            $this->checkSessionPrerequisites();

            return $callable();
        });
    }

    /**
     * Executes an asynchronous request.
     *
     * @param RequestInterface            $request
     * @param ResponseSerializerInterface $serializer
     * @return PromiseInterface<ResponseEnvelope|InstagramException>
     */
    private function doRequest(RequestInterface $request, ResponseSerializerInterface $serializer): PromiseInterface
    {
        $promise = $this->client->requestAsync($request);

        return $promise->then(function (HttpResponseInterface $response) use ($serializer): PromiseInterface {
            return $this->decode($response, $serializer);
        })->otherwise(function (Throwable $exception) use ($serializer): PromiseInterface {
            return $this->decodeError($exception, $serializer);
        });
    }

    /**
     * Decode the response.
     *
     * @param HttpResponseInterface       $response
     * @param ResponseSerializerInterface $serializer
     * @return PromiseInterface<ResponseEnvelope|InstagramException>
     */
    private function decode(HttpResponseInterface $response, ResponseSerializerInterface $serializer): PromiseInterface
    {
        return PromiseUtils::task(function () use ($response, $serializer): ResponseInterface {
            return $serializer->decode($response, $this);
        });
    }

    /**
     * Decodes a error response.
     *
     * @param Throwable                   $throwable
     * @param ResponseSerializerInterface $serializer
     * @return PromiseInterface
     */
    private function decodeError(Throwable $throwable, ResponseSerializerInterface $serializer): PromiseInterface
    {
        if (!self::isRequestException($throwable)) {
            return Create::rejectionFor($throwable);
        }

        // @phan-suppress-next-line PhanUndeclaredMethod
        return $this->decode($throwable->getResponse(), $serializer);
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
     * Returns true if session is available, false otherwise.
     *
     * @return bool
     */
    private function isSessionAvailable(): bool
    {
        return $this->session !== null;
    }

    /**
     * @inheritDoc
     */
    public function __debugInfo()
    {
        return [];
    }
}
