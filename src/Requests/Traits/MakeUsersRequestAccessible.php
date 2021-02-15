<?php

declare(strict_types=1);

namespace Instagram\SDK\Requests\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\Users\UserInformationMessage;

/**
 * Trait MakeUsersRequestAccessible
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait MakeUsersRequestAccessible
{

    /**
     * Returns detailed information about a user by username.
     *
     * @param string $username
     * @return PromiseInterface<UserInformationMessage>
     */
    public function getUserByName(string $username): PromiseInterface
    {
        return $this->getClient()->getUserByName($username);
    }

    /**
     * Returns detailed information about a user by id.
     *
     * @param string $userId
     * @return PromiseInterface<UserInformationMessage>
     */
    public function getUserById(string $userId): PromiseInterface
    {
        return $this->getClient()->getUserById($userId);
    }

    // TODO, news, news/inbox, pending friendships, block, unblock

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
