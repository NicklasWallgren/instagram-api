<?php

namespace NicklasW\Instagram\Requests;

use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\HttpClients\Client as HttpClient;
use NicklasW\Instagram\Requests\Http\Builders\InboxRequestBuilder;
use NicklasW\Instagram\Requests\Traits\RequestMethods;
use NicklasW\Instagram\Responses\LoginResponseMessage;
use NicklasW\Instagram\Responses\Serializers\InboxSerializer;
use NicklasW\Instagram\Session\Session;

class InboxRequest extends Request
{

    use RequestMethods;

    /**
     * @var Client
     */
    protected $client;

    /**
     * InboxRequest constructor.
     *
     * @param Client     $client
     * @param Session    $session
     * @param HttpClient $httpClient
     */
    public function __construct(Client $client, Session $session, HttpClient $httpClient)
    {
        $this->client = $client;

        parent::__construct($session, $httpClient);
    }

    /**
     * Fire the request.
     *
     * @return Promise
     */
    public function fire(): Promise
    {
        $request = new InboxRequestBuilder($this->session);

        return $this->request($request->build(), new InboxSerializer($this->client));
    }

}