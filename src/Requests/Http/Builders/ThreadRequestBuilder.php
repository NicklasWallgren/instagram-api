<?php

namespace NicklasW\Instagram\Requests\Http\Builders;

use GuzzleHttp\Psr7\Request;
use NicklasW\Instagram\HttpClients\Client;
use NicklasW\Instagram\Requests\Http\Marshallers\SerializerInterface;
use NicklasW\Instagram\Requests\Http\Traits\RequestQueryMethodsTrait;
use NicklasW\Instagram\Session\Session;

class ThreadRequestBuilder extends AbstractRequestBuilder
{

    use RequestQueryMethodsTrait;

    /**
     * @var string The inbox request uri
     */
    protected const REQUEST_URI = 'direct_v2/threads/';

    /**
     * @var string The uri template
     */
    protected static $URI_TEMPLATE = '%s/';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $cursor;

    /**
     * ThreadRequestBuilder constructor.
     *
     * @param Session     $session
     * @param string      $id
     * @param string|null $cursor
     */
    public function __construct(Session $session, string $id, ?string $cursor = null)
    {
        $this->id = $id;
        $this->cursor = $cursor;

        parent::__construct($session);
    }

    /**
     * Builds HTTP request.
     *
     * @return Request
     */
    public function build(): Request
    {
        return new Request(Client::METHOD_POST, $this->getUri(), $this->getHeaders());
    }

    /**
     * Returns the method uri parameters.
     *
     * @return array
     */
    protected function getMethodUriParameters(): array
    {
        return [$this->id];
    }

    /**
     * Returns the query parameters.
     *
     * @return array
     */
    protected function getQueryParameters(): array
    {
        $query = [];

        // Add the cursor query parameter
        $this->addCursorParameter($query);

        return $query;
    }

    /**
     * Adds the cursor query parameter
     *
     * @param $query
     */
    protected function addCursorParameter(array &$query)
    {
        // Check if the cursor has been defined
        if ($this->cursor !== null) {
            $query['cursor'] = $this->cursor;
        }
    }

    /**
     * The request body serializer.
     *
     * @return SerializerInterface
     */
    protected function serializer(): ?SerializerInterface
    {
        return null;
    }

}