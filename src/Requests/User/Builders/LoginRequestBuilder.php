<?php

namespace Instagram\SDK\Requests\User\Builders;

use Instagram\SDK\Requests\Http\Builders\AbstractPayloadRequestBuilder;
use Instagram\SDK\Requests\Http\Traits\SignedPayloadSerializerTrait;
use Instagram\SDK\Session\Session;

class LoginRequestBuilder extends AbstractPayloadRequestBuilder
{

    use SignedPayloadSerializerTrait;

    /**
     * @var string The login request URI
     */
    protected static $REQUEST_URI = 'accounts/login/';

    /**
     * @var string The username
     */
    protected $username;

    /**
     * @var string The password
     */
    protected $password;

    /**
     * LoginRequestBuilder constructor.
     *
     * @param string  $username
     * @param string  $password
     * @param Session $session
     */
    public function __construct(string $username, string $password, Session $session)
    {
        $this->username = $username;
        $this->password = $password;

        parent::__construct($session);
    }

    /**
     * Returns the body parameters.
     *
     * @return array
     */
    protected function getBodyParameters(): array
    {
        $body = [
            'username'            => $this->username,
            'password'            => $this->password,
            'login_attempt_count' => '0',
        ];

        return $this->addSessionParameters($body);
    }

    /**
     * Adds session parameters.
     *
     * @param array $parameters
     * @return array
     */
    protected function addSessionParameters(&$parameters)
    {
        return $parameters = array_merge([
            'phone_id'   => $this->session->getDevice()->phoneId(),
            'device_id'  => $this->session->getDevice()->deviceId(),
        ], $parameters);
    }
}
