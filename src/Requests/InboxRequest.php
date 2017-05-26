<?php

namespace NicklasW\Instagram\Requests;

use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\DTO\Interfaces\ResponseMessageInterface;
use NicklasW\Instagram\Requests\Http\Builders\InboxRequestBuilder;
use NicklasW\Instagram\Responses\LoginResponseMessage;
use NicklasW\Instagram\Responses\Serializers\InboxSerializer;
use NicklasW\Instagram\HttpClients\Client as HttpClient;
use NicklasW\Instagram\Session\Session;

class InboxRequest extends Request
{

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
     * @return ResponseMessageInterface
     */
    public function fire(): ResponseMessageInterface
    {
        $request = new InboxRequestBuilder($this->session);

        // pass the container class
        // client
        // logged in user

        return (new InboxSerializer($this->client))->decode($this->httpClient->request($request->build()));
    }

}