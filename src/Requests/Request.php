<?php


namespace Instagram\SDK\Requests;

use GuzzleHttp\Promise\Promise;
use Instagram\SDK\Http\Client as HttpClient;
use Instagram\SDK\Session\Session;

abstract class Request
{

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var Session
     */
    protected $session;

    /**
     * Request constructor.
     *
     * @param Session    $session
     * @param HttpClient $client
     */
    public function __construct(Session $session, HttpClient $client)
    {
        $this->session = $session;
        $this->httpClient = $client;
    }

    /**
     * Fire the request.
     *
     * @return Promise
     */
    abstract public function fire(): Promise;
}
