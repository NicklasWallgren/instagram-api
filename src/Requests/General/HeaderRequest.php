<?php

namespace NicklasW\Instagram\Requests\General;

use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\Http\Client as HttpClient;
use NicklasW\Instagram\Requests\General\Builders\HeaderRequestBuilder;
use NicklasW\Instagram\Requests\Request;
use NicklasW\Instagram\Requests\Traits\RequestMethods;
use NicklasW\Instagram\Responses\Serializers\General\HeaderSerializer;
use NicklasW\Instagram\Session\Session;

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
