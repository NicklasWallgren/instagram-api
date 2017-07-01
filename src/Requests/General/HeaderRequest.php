<?php

namespace Instagram\SDK\Requests\General;

use GuzzleHttp\Promise\Promise;
use Instagram\SDK\Http\Client as HttpClient;
use Instagram\SDK\Requests\General\Builders\HeaderRequestBuilder;
use Instagram\SDK\Requests\Request;
use Instagram\SDK\Requests\Traits\RequestMethods;
use Instagram\SDK\Responses\Serializers\General\HeaderSerializer;
use Instagram\SDK\Session\Session;

class HeaderRequest extends Request
{

    use RequestMethods;

    /**
     * @var string
     */
    protected $signature;

    /**
     * HeaderRequest constructor.
     *
     * @param string     $signature The universal unique identifier
     * @param Session    $session
     * @param HttpClient $client
     */
    public function __construct(string $signature, Session $session, HttpClient $client)
    {
        $this->signature = $signature;

        parent::__construct($session, $client);
    }

    /**
     * Fire the request.
     *
     * @return Promise
     */
    public function fire(): Promise
    {
        // Build the request instance
        $request = new HeaderRequestBuilder($this->signature, $this->session);

        // Return a promise chain
        return $this->request($request->build(), new HeaderSerializer());
    }
}
