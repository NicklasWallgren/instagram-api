<?php

namespace NicklasW\Instagram\Requests\General\Builders;

use NicklasW\Instagram\Requests\Http\Builders\AbstractPayloadRequestBuilder;
use NicklasW\Instagram\Requests\Http\Traits\UrlEncodedSerializerTrait;
use NicklasW\Instagram\Session\Session;

class HeaderRequestBuilder extends AbstractPayloadRequestBuilder
{

    use UrlEncodedSerializerTrait;

    /**
     * @var string The login request URI
     */
    protected static $REQUEST_URI = 'si/fetch_headers/';

    /**
     * @var string The signature
     */
    protected $signature;

    /**
     * HeaderRequestBuilder constructor.
     *
     * @param string  $signature
     * @param Session $session
     */
    public function __construct(string $signature, Session $session)
    {
        $this->signature = $signature;

        parent::__construct($session);
    }

    /**
     * Returns the body parameters.
     *
     * @return array
     */
    protected function getBodyParameters(): array
    {
        return [
            'challenge_type' => 'signup',
            'guid'           => $this->signature,
        ];
    }
}
