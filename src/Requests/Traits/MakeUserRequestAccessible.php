<?php

namespace Instagram\SDK\Requests\Traits;

use GuzzleHttp\Promise\Promise;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\User\LogoutMessage;
use Instagram\SDK\DTO\Messages\User\SessionMessage;

/**
 * Trait MakeUserRequestAccessible
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait MakeUserRequestAccessible
{

    /**
     * Login a user.
     *
     * @param string $username
     * @param string $password
     * @return SessionMessage|Promise<SessionMessage>
     * @throws \Exception
     */
    public function login(string $username, string $password)
    {
        return $this->getClient()->login($username, $password);
    }

    /**
     * Login a user using nonce.
     *
     * @param string $nonce
     * @return SessionMessage|Promise<InboxMessage>
     */
    public function loginUsingNonce(string $nonce)
    {
        return $this->getClient()->loginUsingNonce($nonce);
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
