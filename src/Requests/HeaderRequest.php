<?php

namespace NicklasW\Instagram\Requests;

use NicklasW\Instagram\DTO\Interfaces\ResponseMessageInterface;
use NicklasW\Instagram\Requests\Http\Builders\HeaderRequestBuilder;
use NicklasW\Instagram\Responses\Serializers\HeaderSerializer;
use NicklasW\Instagram\Session\Session;
use NicklasW\Instagram\HttpClients\Client as HttpClient;

class HeaderRequest extends Request
{

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
     * @return ResponseMessageInterface
     */
    public function fire(): ResponseMessageInterface
    {
        // Build the request instance
        $request = new HeaderRequestBuilder($this->signature, $this->session);

        return (new HeaderSerializer())->decode($this->httpClient->request($request->build()));
    }

}