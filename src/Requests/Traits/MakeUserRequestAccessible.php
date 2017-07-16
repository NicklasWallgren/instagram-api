<?php

namespace Instagram\SDK\Requests\Traits;

use GuzzleHttp\Promise\Promise;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\User\LogoutMessage;
use Instagram\SDK\DTO\Messages\User\SessionMessage;

trait MakeUserRequestAccessible
{

    /**
     * Login a user
     *
     * @param string $username
     * @param string $password
     * @return SessionMessage|Promise<SessionMessage>
     */
    public function login(string $username, string $password)
    {
        return $this->getClient()->login($username, $password);
    }

    /**
     * Logout the authenticated user.
     *
     * @return LogoutMessage|Promise<LogoutMessage>
     */
    public function logout()
    {
        return $this->getClient()->logout();
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
