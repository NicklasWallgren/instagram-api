<?php

namespace Instagram\SDK\Requests\Traits;

use GuzzleHttp\Promise\Promise;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\SessionMessage;

trait MakeGeneralRequestAccessible
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
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
