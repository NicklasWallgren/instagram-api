<?php


namespace NicklasW\Instagram\Requests;

use NicklasW\Instagram\DTO\Interfaces\ResponseMessageInterface;
use NicklasW\Instagram\HttpClients\Client as HttpClient;
use NicklasW\Instagram\Session\Session;

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
     * @return ResponseMessageInterface
     */
    abstract public function fire(): ResponseMessageInterface;

}