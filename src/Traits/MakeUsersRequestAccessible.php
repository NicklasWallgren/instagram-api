<?php

declare(strict_types=1);

namespace Instagram\SDK\Traits;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\Responses\Users\UserInformationResponse;
use Instagram\SDK\Utils\PromiseUtils;

/**
 * Trait MakeUsersRequestAccessible
 *
 * @package Instagram\SDK\Traits
 */
trait MakeUsersRequestAccessible
{

    /**
     * Return detailed information about a user by username.
     *
     * @param string $username
     * @return UserInformationResponse
     * @throws InstagramException in case of an error
     */
    public function userByName(string $username): UserInformationResponse
    {
        return PromiseUtils::wait($this->getClient()->getUserByName($username));
    }

    /**
     * Return detailed information about a user by id.
     *
     * @param string $userId
     * @return UserInformationResponse
     * @throws InstagramException in case of an error
     */
    public function userById(string $userId): UserInformationResponse
    {
        return PromiseUtils::wait($this->getClient()->getUserById($userId));
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
