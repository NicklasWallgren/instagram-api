<?php

declare(strict_types=1);

namespace Instagram\SDK\Request\Http\Builders;

use GuzzleHttp\Psr7\Request;
use Instagram\SDK\Device\DeviceInterface;
use Instagram\SDK\Exceptions\EncodingException;
use Instagram\SDK\Request\Http\Factories\PayloadSerializerFactory;
use Instagram\SDK\Request\Http\Utils\RequestUtils;
use InvalidArgumentException;
use Webmozart\Assert\Assert;

/**
 * Class RequestBuilder
 *
 * @package Instagram\SDK\Request\Http\Builders
 */
class RequestBuilder implements RequestBuilderInterface
{

    private const ENDPOINT_URL = 'i.instagram.com';

    /** @var string */
    private $uri;

    /** @var string */
    private $method;

    /** @var DeviceInterface */
    private $device;

    /** @var array<string, mixed> */
    private $queryParameters = [];

    /** @var array<string, mixed> */
    private $payload = [];

    /** @var int */
    private $payloadSerializerType = PayloadSerializerFactory::TYPE_URL_ENCODED;

    /**
     * GenericRequestBuilder constructor.
     *
     * @param string          $uri
     * @param string          $method
     * @param DeviceInterface $device
     * @throws InvalidArgumentException
     */
    public function __construct(string $uri, string $method, DeviceInterface $device)
    {
        Assert::oneOf($method, ['GET', 'POST']);

        $this->uri = $uri;
        $this->method = $method;
        $this->device = $device;
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
     * @throws EncodingException|InvalidArgumentException
     */
    public function build(): Request
    {
        $serializer = PayloadSerializerFactory::create($this->payloadSerializerType);

        return new Request(
            $this->method,
            RequestUtils::createUri(self::ENDPOINT_URL, $this->uri, $this->queryParameters),
            HeadersBuilder::builder()->setDevice($this->device)->build(),
            $serializer->encode($this->payload)
        );
    }
}
