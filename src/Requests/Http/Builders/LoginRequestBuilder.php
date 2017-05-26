<?php

namespace NicklasW\Instagram\Requests\Http\Builders;

use GuzzleHttp\Psr7\Request;
use NicklasW\Instagram\HttpClients\Client;
use NicklasW\Instagram\Requests\Http\Marshallers\SerializerInterface;
use NicklasW\Instagram\Requests\Http\Marshallers\UrlEncodedSerializer;
use NicklasW\Instagram\Requests\Http\Traits\RequestBodyMethodsTrait;
use NicklasW\Instagram\Requests\Support\SignatureSupport;
use NicklasW\Instagram\Session\Session;
use Psr\Http\Message\StreamInterface;

class LoginRequestBuilder extends AbstractRequestBuilder
{

    use RequestBodyMethodsTrait;

    /**
     * @var string The login request URI
     */
    protected const REQUEST_URI = 'accounts/login/';

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
     * Builds the HTTP request.
     *
     * @return Request
     */
    public function build(): Request
    {
        return new Request(Client::METHOD_POST,
            $this->getUri(),
            $this->getHeaders(),
            $this->getBody());
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
            'guid'       => $this->session->getUuid(),
            'device_id'  => $this->session->getDevice()->deviceId(),
            '_csrftoken' => sprintf('Set-Cookie: csrftoken=%s', $this->session->getCsrfToken()->getToken()),
        ], $parameters);
    }

    /**
     * The request body serializer.
     *
     * @return SerializerInterface
     */
    protected function serializer(): SerializerInterface
    {
        return new class implements SerializerInterface
        {

            /**
             * Encodes the body.
             *
             * @param string $body
             * @return null|StreamInterface|resource|string
             */
            public function encode($body)
            {
                return SignatureSupport::signature(json_encode($body));
            }
        };
    }
}