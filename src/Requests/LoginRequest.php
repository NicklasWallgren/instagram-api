<?php

namespace NicklasW\Instagram\Requests;

use NicklasW\Instagram\Requests\Http\Builders\LoginRequestBuilder;
use NicklasW\Instagram\Responses\LoginResponseMessage;
use NicklasW\Instagram\Responses\Serializers\LoginSerializer;
use NicklasW\Instagram\Session\Session;
use NicklasW\Instagram\DTO\Interfaces\ResponseMessageInterface;
use NicklasW\Instagram\HttpClients\Client as HttpClient;

class LoginRequest extends Request
{

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
     * @return ResponseMessageInterface
     */
    public function fire(): ResponseMessageInterface
    {
        $request = new LoginRequestBuilder($this->username, $this->password, $this->session);

        return (new LoginSerializer($this->session, $this->httpClient))->decode($this->httpClient->request($request->build()));
    }

}