<?php

namespace Instagram\SDK\Requests\General\Builders;

use Instagram\SDK\Requests\Http\Builders\AbstractPayloadRequestBuilder;
use Instagram\SDK\Requests\Http\Traits\UrlEncodedSerializerTrait;
use Instagram\SDK\Session\Session;

/**
 * Class HeaderRequestBuilder
 *
 * @package Instagram\SDK\Requests\General\Builders
 */
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
