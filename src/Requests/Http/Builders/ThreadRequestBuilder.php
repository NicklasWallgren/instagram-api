<?php

namespace NicklasW\Instagram\Requests\Http\Builders;

use NicklasW\Instagram\Session\Session;

class ThreadRequestBuilder extends AbstractQueryRequestBuilder
{

    /**
     * @var string The inbox request uri
     */
    protected static $REQUEST_URI = 'direct_v2/threads/';

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

}