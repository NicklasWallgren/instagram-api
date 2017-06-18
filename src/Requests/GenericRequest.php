<?php

namespace NicklasW\Instagram\Requests;

use NicklasW\Instagram\HttpClients\Client as HttpClient;
use NicklasW\Instagram\Requests\Http\Builders\AbstractQueryRequestBuilder;
use NicklasW\Instagram\Requests\Http\Builders\GenericRequestBuilder;
use NicklasW\Instagram\Requests\Traits\RequestMethods;
use NicklasW\Instagram\Responses\Serializers\AbstractSerializer;
use NicklasW\Instagram\Session\Session;
use GuzzleHttp\Promise\Promise;

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
     * Sets a post payload.
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