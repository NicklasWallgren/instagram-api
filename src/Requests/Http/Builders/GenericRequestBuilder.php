<?php

namespace NicklasW\Instagram\Requests\Http\Builders;

use NicklasW\Instagram\Session\Session;

class GenericRequestBuilder extends AbstractQueryRequestBuilder
{

    /**
     * @var string
     */
    protected $uri;

    /**
     * GenericRequestBuilder constructor.
     *
     * @param string  $uri
     * @param Session $session
     */
    public function __construct(string $uri, Session $session)
    {
        $this->uri = $uri;

        parent::__construct($session);
    }

    /**
     * Returns the request uri.
     *
     * @return string
     */
    protected function getRequestUri(): string
    {
        return $this->uri;
    }

}