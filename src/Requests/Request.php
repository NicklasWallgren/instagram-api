<?php

namespace Instagram\SDK\Requests;

use Instagram\SDK\Requests\Exceptions\EncodingException;
use Instagram\SDK\Requests\Http\Builders\RequestBuilder;
use Instagram\SDK\Requests\Options\AbstractOptions;
use Instagram\SDK\Requests\Traits\RequestMethods;
use Instagram\SDK\Responses\Interfaces\SerializerInterface;
use InvalidArgumentException;

/**
 * Class Request
 *
 * @package Instagram\SDK\Requests
 */
class Request
{

    use RequestMethods;

    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * Request constructor.
     *
     * @param RequestBuilder      $requestBuilder
     * @param SerializerInterface $serializer
     */
    public function __construct(RequestBuilder $requestBuilder, SerializerInterface $serializer)
    {
        $this->requestBuilder = $requestBuilder;
        $this->serializer = $serializer;
    }

    /**
     * Add a query parameter.
     *
     * @param string $parameter
     * @param mixed  $value
     * @return Request
     */
    public function addQueryParam(string $parameter, $value): Request
    {
        $this->requestBuilder->addQueryParam($parameter, $value);

        return $this;
    }

    /**
     * Add a payload parameter.
     *
     * @param string $parameter
     * @param mixed  $value
     * @return Request
     */
    public function addPayloadParam(string $parameter, $value): Request
    {
        $this->requestBuilder->addPayloadParam($parameter, $value);

        return $this;
    }

    /**
     * Sets the payload.
     *
     * @param array<string, mixed> $payload
     * @return Request
     */
    public function setPayload(array $payload): Request
    {
        $this->requestBuilder->setPayload($payload);

        return $this;
    }

    /**
     * Sets the payload serializer mode.
     *
     * @param int $serializerType
     * @return Request
     * @throws InvalidArgumentException
     */
    public function setPayloadSerializerType(int $serializerType): Request
    {
        $this->requestBuilder->setPayloadSerializerType($serializerType);

        return $this;
    }

    /**
     * Add a query parameter if defined.
     *
     * @param string      $name
     * @param string|null $value
     * @return Request
     */
    public function addQueryParamIfNotNull(string $name, ?string $value): Request
    {
        // Check whether the value is defined
        if ($value === null) {
            return $this;
        }

        return $this->addQueryParam($name, $value);
    }

    /**
     * Add payload options.
     *
     * @param AbstractOptions $options
     * @return static
     */
    public function addPayloadOptions(AbstractOptions $options): Request
    {
        $options->addAsPayload($this);

        return $this;
    }

    /**
     * @return SerializerInterface
     */
    public function getSerializer(): SerializerInterface
    {
        return $this->serializer;
    }

    /**
     * @return \GuzzleHttp\Psr7\Request
     * @throws EncodingException
     * @suppress PhanThrowTypeAbsentForCall
     */
    public function toHttpRequest(): \GuzzleHttp\Psr7\Request
    {
        return $this->requestBuilder->build();
    }

}
