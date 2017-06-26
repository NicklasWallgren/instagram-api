<?php

namespace NicklasW\Instagram\Requests\User;

use GuzzleHttp\Promise\Promise;
use NicklasW\Instagram\Http\Client as HttpClient;
use NicklasW\Instagram\Requests\Request;
use NicklasW\Instagram\Requests\Traits\RequestMethods;
use NicklasW\Instagram\Requests\User\Builders\LoginRequestBuilder;
use NicklasW\Instagram\Responses\LoginResponseMessage;
use NicklasW\Instagram\Responses\Serializers\User\LoginSerializer;
use NicklasW\Instagram\Session\Session;

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
