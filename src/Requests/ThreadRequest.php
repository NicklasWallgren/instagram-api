<?php

namespace NicklasW\Instagram\Requests;

use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\DTO\Interfaces\ResponseMessageInterface;
use NicklasW\Instagram\Requests\Http\Builders\ThreadRequestBuilder;
use NicklasW\Instagram\Responses\LoginResponseMessage;
use NicklasW\Instagram\Responses\Serializers\ThreadSerializer;
use NicklasW\Instagram\Session\Session;
use NicklasW\Instagram\HttpClients\Client as HttpClient;

class ThreadRequest extends Request
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string The thread id
     */
    protected $id;

    /**
     * @var string|null The cursor
     */
    protected $cursor;

    /**
     * ThreadRequest constructor.
     *
     * @param Client      $client
     * @param Session     $session
     * @param HttpClient  $httpClient
     * @param string      $id
     * @param string|null $cursor
     */
    public function __construct(Client $client, Session $session, HttpClient $httpClient, string $id, ?string $cursor = null)
    {
        $this->client = $client;
        $this->id = $id;
        $this->cursor = $cursor;

        parent::__construct($session, $httpClient);
    }

    /**
     * Fire the request.
     *
     * @return ResponseMessageInterface
     */
    public function fire(): ResponseMessageInterface
    {
        $request = (new ThreadRequestBuilder($this->session, $this->id, $this->cursor));

        return (new ThreadSerializer($this->client))->decode($this->httpClient->request($request->build()));
    }

}