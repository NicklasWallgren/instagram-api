<?php

namespace Instagram\SDK\Requests\Direct;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Http\RequestClient as HttpClient;
use Instagram\SDK\Requests\Direct\Builders\InboxRequestBuilder;
use Instagram\SDK\Requests\Request;
use Instagram\SDK\Requests\Traits\RequestMethods;
use Instagram\SDK\Responses\LoginResponseMessage;
use Instagram\SDK\Responses\Serializers\Direct\InboxSerializer;
use Instagram\SDK\Session\Session;
use Instagram\SDK\Support\Promise;

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
        // Build the request instance
        $request = new InboxRequestBuilder($this->session);

        // Return a promise chain
        return $this->request($request->build(), new InboxSerializer($this->client));
    }
}
