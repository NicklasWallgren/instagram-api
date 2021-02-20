<?php

namespace Instagram\SDK\Requests\Http\Builders;

use GuzzleHttp\Psr7\Request;
use Instagram\SDK\Requests\Exceptions\EncodingException;
use Instagram\SDK\Requests\Http\Factories\PayloadSerializerFactory;
use Instagram\SDK\Requests\Http\HeadersBuilder;
use Instagram\SDK\Requests\Http\Utils\RequestUtils;
use Instagram\SDK\Session\Session;
use InvalidArgumentException;
use Webmozart\Assert\Assert;

/**
 * Class RequestBuilder
 *
 * @package Instagram\SDK\Requests\Http\Builders
 */
class RequestBuilder implements RequestBuilderInterface
{

    private const ENDPOINT_URL = 'i.instagram.com';

    /** @var string */
    private $uri;

    /** @var string */
    private $method;

    /** @var Session */
    private $session;

    /** @var array<string, mixed> */
    private $queryParameters = [];

    /** @var array<string, mixed> */
    private $payload = [];

    /** @var int */
    private $payloadSerializerType = PayloadSerializerFactory::TYPE_URL_ENCODED;

    /**
     * GenericRequestBuilder constructor.
     *
     * @param string  $uri
     * @param string  $method
     * @param Session $session
     * @throws InvalidArgumentException
     */
    public function __construct(string $uri, string $method, Session $session)
    {
        Assert::oneOf($method, ['GET', 'POST']);

        $this->uri = $uri;
        $this->method = $method;
        $this->session = $session;
    }

    /**
     * Sets a post parameter.
     *
     * @param string $name
     * @param mixed  $value
     * @return RequestBuilder
     */
    public function addPayloadParam(string $name, $value): RequestBuilder
    {
        $this->payload[$name] = $value;

        return $this;
    }

    /**
     * Sets the payload.
     *
     * @param array<string, mixed> $payload
     * @return RequestBuilder
     */
    public function setPayload(array $payload): RequestBuilder
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Sets a query parameter.
     *
     * @param string $name
     * @param mixed  $value
     * @return RequestBuilder
     */
    public function addQueryParam(string $name, $value): RequestBuilder
    {
        $this->queryParameters[$name] = $value;

        return $this;
    }

    /**
     * @param int $payloadSerializerType
     * @return static
     * @throws InvalidArgumentException
     */
    public function setPayloadSerializerType(int $payloadSerializerType): RequestBuilder
    {
        Assert::oneOf($payloadSerializerType, PayloadSerializerFactory::VALID_SERIALIZERS);

        $this->payloadSerializerType = $payloadSerializerType;
        return $this;
    }

    /**
     * @inheritDoc
     * @throws InvalidArgumentException
     * @throws EncodingException
     */
    public function build(): Request
    {
        $serializer = PayloadSerializerFactory::create($this->payloadSerializerType);

        return new Request(
            $this->method,
            RequestUtils::createUri(self::ENDPOINT_URL, $this->uri, $this->queryParameters),
            (new HeadersBuilder())->build($this->session),
            $serializer->encode($this->payload)
        );
    }
}
