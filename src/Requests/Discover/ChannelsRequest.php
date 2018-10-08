<?php


namespace Instagram\SDK\Requests\Discover;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Http\RequestClient as HttpClient;
use Instagram\SDK\Requests\Discover\Builders\ChannelsRequestBuilder;
use Instagram\SDK\Requests\Request;
use Instagram\SDK\Requests\Traits\RequestMethods;
use Instagram\SDK\Responses\Serializers\Discover\ChannelsSerializer;
use Instagram\SDK\Session\Session;
use Instagram\SDK\Support\Promise;

/**
 * Class ChannelsRequest
 *
 * @package Instagram\SDK\Requests\Discover
 */
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
