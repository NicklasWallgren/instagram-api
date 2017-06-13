<?php

namespace NicklasW\Instagram\Requests;

use NicklasW\Instagram\HttpClients\Client as HttpClient;
use NicklasW\Instagram\Requests\Http\Builders\AbstractQueryRequestBuilder;
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
     * @param Session                     $session
     * @param HttpClient                  $httpClient
     * @param AbstractQueryRequestBuilder $requestBuilder
     * @param AbstractSerializer          $serializer
     */
    public function __construct(Session $session, HttpClient $httpClient, AbstractQueryRequestBuilder $requestBuilder, AbstractSerializer $serializer)
    {
        $this->requestBuilder = $requestBuilder;
        $this->serializer = $serializer;

        parent::__construct($session, $httpClient);
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