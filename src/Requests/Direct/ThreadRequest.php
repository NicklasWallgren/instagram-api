<?php

namespace Instagram\SDK\Requests\Direct;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Http\RequestClient as HttpClient;
use Instagram\SDK\Requests\Direct\Builders\ThreadRequestBuilder;
use Instagram\SDK\Requests\Request;
use Instagram\SDK\Requests\Traits\RequestMethods;
use Instagram\SDK\Responses\LoginResponseMessage;
use Instagram\SDK\Responses\Serializers\Direct\ThreadSerializer;
use Instagram\SDK\Session\Session;
use Instagram\SDK\Support\Promise;

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
    public function __construct(
        Client $client,
        Session $session,
        HttpClient $httpClient,
        string $id,
        ?string $cursor = null
    ) {
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
