<?php

declare(strict_types=1);

namespace Instagram\SDK\Request;

use Instagram\SDK\Exceptions\EncodingException;
use Instagram\SDK\Request\Http\Builders\RequestBuilder;
use Instagram\SDK\Response\Interfaces\ResponseSerializerInterface;
use InvalidArgumentException;

/**
 * Class Request
 *
 * @package Instagram\SDK\Request
 */
class Request
{

    use RequestBuilderMethods;

    /** @var RequestBuilder */
    private $requestBuilder;

    /** @var ResponseSerializerInterface */
    private $serializer;

    /**
     * Request constructor.
     *
     * @param RequestBuilder              $requestBuilder
     * @param ResponseSerializerInterface $serializer
     */
    public function __construct(RequestBuilder $requestBuilder, ResponseSerializerInterface $serializer)
    {
        $this->requestBuilder = $requestBuilder;
        $this->serializer = $serializer;
    }

    /**
     * @param int $serializerType
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setPayloadSerializerType(int $serializerType): Request
    {
        $this->requestBuilder->setPayloadSerializerType($serializerType);

        return $this;
    }

    /**
     * @return ResponseSerializerInterface
     */
    public function getSerializer(): ResponseSerializerInterface
    {
        return $this->serializer;
    }

    /**
     * @param ResponseSerializerInterface $serializer
     * @return static
     */
    public function setResponseSerializer(ResponseSerializerInterface $serializer)
    {
        $this->serializer = $serializer;
        return $this;
    }

    /**
     * @return \GuzzleHttp\Psr7\Request
     * @throws EncodingException|InvalidArgumentException
     * @suppress PhanThrowTypeAbsentForCall
     */
    public function toHttpRequest(): \GuzzleHttp\Psr7\Request
    {
        return $this->requestBuilder->build();
    }
}
