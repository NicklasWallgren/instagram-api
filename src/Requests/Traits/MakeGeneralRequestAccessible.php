<?php

namespace Instagram\SDK\Requests\Traits;

use GuzzleHttp\Promise\Promise;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\User\LogoutMessage;
use Instagram\SDK\DTO\Messages\User\SessionMessage;

trait MakeGeneralRequestAccessible
{

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
