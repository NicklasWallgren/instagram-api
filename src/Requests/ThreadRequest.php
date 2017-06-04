<?php

namespace NicklasW\Instagram\Requests;

use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\HttpClients\Client as HttpClient;
use NicklasW\Instagram\Requests\Http\Builders\ThreadRequestBuilder;
use NicklasW\Instagram\Requests\Traits\RequestMethods;
use NicklasW\Instagram\Responses\LoginResponseMessage;
use NicklasW\Instagram\Responses\Serializers\ThreadSerializer;
use NicklasW\Instagram\Session\Session;
use function GuzzleHttp\Promise\task;

class ThreadRequest extends Request
{

    use RequestMethods;

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
     * @return Promise<ThreadMessage>
     */
    public function fire(): Promise
    {
        // Build the request instance
        $request = (new ThreadRequestBuilder($this->session, $this->id, $this->cursor));

        // Return a promise chain
        return $this->request($request->build(), new ThreadSerializer($this->client));
    }

}