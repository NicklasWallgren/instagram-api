<?php

namespace Instagram\SDK\Requests\User;

use Instagram\SDK\Http\RequestClient as HttpClient;
use Instagram\SDK\Requests\Request;
use Instagram\SDK\Requests\Traits\RequestMethods;
use Instagram\SDK\Requests\User\Builders\LoginRequestBuilder;
use Instagram\SDK\Responses\LoginResponseMessage;
use Instagram\SDK\Responses\Serializers\User\LoginSerializer;
use Instagram\SDK\Session\Session;
use Instagram\SDK\Support\Promise;

class LoginRequest extends Request
{

    use RequestMethods;

    /**
     * @var string The username
     */
    protected $username;

    /**
     * @var string The password
     */
    protected $password;

    /**
     * LoginRequest constructor.
     *
     * @param string  $username
     * @param string  $password
     * @param Session $session
     */
    public function __construct(string $username, string $password, Session $session, HttpClient $client)
    {
        $this->username = $username;
        $this->password = $password;

        parent::__construct($session, $client);
    }

    /**
     * Fire the request.
     *
     * @return Promise
     */
    public function fire(): Promise
    {
        // Build the request instance
        $request = new LoginRequestBuilder($this->username, $this->password, $this->session);

        // Return a promise chain
        return $this->request($request->build(), new LoginSerializer($this->session, $this->httpClient));
    }
}
