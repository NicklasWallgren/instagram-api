<?php


namespace NicklasW\Instagram\Requests\Discover;

use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\Client\Client;
use NicklasW\Instagram\Http\Client as HttpClient;
use NicklasW\Instagram\Requests\Discover\Builders\ChannelsRequestBuilder;
use NicklasW\Instagram\Requests\Request;
use NicklasW\Instagram\Requests\Traits\RequestMethods;
use NicklasW\Instagram\Responses\Serializers\Discover\ChannelsSerializer;
use NicklasW\Instagram\Session\Session;

class ChannelsRequest extends Request
{

    use RequestMethods;

    /**
     * @var Client
     */
    protected $client;

    /**
     * ExploreRequest constructor.
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
        $request = new ChannelsRequestBuilder($this->session);

        // Return a promise chain
        return $this->request($request->build(), new ChannelsSerializer($this->client));
    }

}