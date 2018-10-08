<?php


namespace Instagram\SDK\Requests;

use Instagram\SDK\Http\RequestClient;
use Instagram\SDK\Session\Session;
use Instagram\SDK\Support\Promise;

/**
 * Class Request
 *
 * @package Instagram\SDK\Requests
 */
abstract class Request
{

    /**
     * @var RequestClient
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
     * @param RequestClient $client
     */
    public function __construct(Session $session, RequestClient $client)
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
