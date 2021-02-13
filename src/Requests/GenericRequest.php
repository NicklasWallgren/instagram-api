<?php

namespace Instagram\SDK\Requests;

use Instagram\SDK\Http\RequestClient as HttpClient;
use Instagram\SDK\Requests\Http\Builders\GenericRequestBuilder;
use Instagram\SDK\Requests\Options\AbstractOptions;
use Instagram\SDK\Requests\Traits\RequestMethods;
use Instagram\SDK\Responses\Interfaces\SerializerInterface;
use Instagram\SDK\Responses\Serializers\AbstractSerializer;
use Instagram\SDK\Session\Session;
use Instagram\SDK\Support\Promise;
use InvalidArgumentException;

/**
 * Class GenericRequest
 *
 * @package Instagram\SDK\Requests
 */
class GenericRequest extends Request
{

    use RequestMethods;

    /**
     * @var GenericRequestBuilder
     */
    protected $requestBuilder;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * GenericRequest constructor.
     *
     * @param Session               $session
     * @param HttpClient            $httpClient
     * @param GenericRequestBuilder $requestBuilder
     * @param SerializerInterface   $serializer
     */
    public function __construct(
        Session $session,
        HttpClient $httpClient,
        GenericRequestBuilder $requestBuilder,
        SerializerInterface $serializer
    ) {
        $this->requestBuilder = $requestBuilder;
        $this->serializer = $serializer;

        parent::__construct($session, $httpClient);
    }

    /**
     * Sets a query parameter.
     *
     * @param string $parameter
     * @param mixed  $value
     * @return GenericRequest
     */
    public function addQueryParam(string $parameter, $value): GenericRequest
    {
        $this->requestBuilder->addQueryParam($parameter, $value);

        return $this;
    }

    /**
     * Sets a post payload parameter.
     *
     * @param string $parameter
     * @param mixed  $value
     * @return GenericRequest
     */
    public function addPayloadParam(string $parameter, $value): GenericRequest
    {
        $this->requestBuilder->addPayloadParam($parameter, $value);

        return $this;
    }

    /**
     * Sets the post payload.
     *
     * @param array<string, mixed> $payload
     * @return GenericRequest
     */
    public function setPayload(array $payload): GenericRequest
    {
        $this->requestBuilder->setPayload($payload);

        return $this;
    }

    /**
     * Sets the serializer mode.
     *
     * @param int $serializerType
     * @return GenericRequest
     * @throws InvalidArgumentException
     */
    public function setSerializerType(int $serializerType): GenericRequest
    {
        $this->requestBuilder->setSerializerType($serializerType);

        return $this;
    }

    /**
     * Sets the query parameter if defined.
     *
     * @param string      $name
     * @param string|null $value
     * @return GenericRequest
     */
    public function addQueryParamIfNotNull(string $name, ?string $value): GenericRequest
    {
        // Check whether the value is defined
        if ($value === null) {
            return $this;
        }

        return $this->addQueryParam($name, $value);
    }

    /**
     * Adds payload options.
     *
     * @param AbstractOptions $options
     * @return static
     */
    public function addPayloadOptions(AbstractOptions $options): GenericRequest
    {
        $options->addAsPayload($this);

        return $this;
    }

    /**
     * Fire the request.
     *
     * @return Promise
     * @suppress PhanThrowTypeAbsentForCall
     */
    public function fire(): Promise
    {
        // Return a promise chain
        return $this->request($this->requestBuilder->build(), $this->serializer);
    }
}
