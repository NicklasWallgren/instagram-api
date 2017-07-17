<?php

namespace Instagram\SDK\Requests;

use Instagram\SDK\Http\RequestClient as HttpClient;
use Instagram\SDK\Requests\Http\Builders\AbstractQueryRequestBuilder;
use Instagram\SDK\Requests\Http\Builders\GenericRequestBuilder;
use Instagram\SDK\Requests\Traits\RequestMethods;
use Instagram\SDK\Responses\Serializers\AbstractSerializer;
use Instagram\SDK\Session\Session;
use Instagram\SDK\Support\Promise;

class GenericRequest extends Request
{

    use RequestMethods;

    /**
     * @var AbstractQueryRequestBuilder
     */
    protected $requestBuilder;

    /**
     * @var AbstractSerializer
     */
    protected $serializer;

    /**
     * GenericRequest constructor.
     *
     * @param Session               $session
     * @param HttpClient            $httpClient
     * @param GenericRequestBuilder $requestBuilder
     * @param AbstractSerializer    $serializer
     */
    public function __construct(
        Session $session,
        HttpClient $httpClient,
        GenericRequestBuilder $requestBuilder,
        AbstractSerializer $serializer
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
    public function setParam(string $parameter, $value): GenericRequest
    {
        $this->requestBuilder->setParam($parameter, $value);

        return $this;
    }

    /**
     * Sets a post payload parameter.
     *
     * @param string $parameter
     * @param mixed  $value
     * @return GenericRequest
     */
    public function setPost(string $parameter, $value): GenericRequest
    {
        $this->requestBuilder->setPost($parameter, $value);

        return $this;
    }

    /**
     * Sets the post payload.
     *
     * @param array $payload
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
     * @param string $mode
     * @return GenericRequest
     */
    public function setMode(string $mode): GenericRequest
    {
        $this->requestBuilder->setMode($mode);

        return $this;
    }

    /**
     * Sets the query parameter if defined.
     *
     * @param string $name
     * @param string $value
     * @return GenericRequest
     */
    public function addParam(string $name, ?string $value): GenericRequest
    {
        // Check whether the value is defined
        if ($value === null) {
            return $this;
        }

        return $this->setParam($name, $value);
    }

    /**
     * Fire the request.
     *
     * @return Promise
     */
    public function fire(): Promise
    {
        // Return a promise chain
        return $this->request($this->requestBuilder->build(), $this->serializer);
    }
}
