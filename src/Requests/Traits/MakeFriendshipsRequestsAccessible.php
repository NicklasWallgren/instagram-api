<?php

namespace Instagram\SDK\Requests\Traits;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\Friendships\FollowersMessage;
use Instagram\SDK\DTO\Messages\Friendships\FollowMessage;
use Instagram\SDK\Support\Promise;

/**
 * Trait MakeFriendshipsRequestsAccessible
 *
 * @package Instagram\SDK\Requests\Traits
 */
trait MakeFriendshipsRequestsAccessible
{

    /**
     * Follow a user by user id.
     *
     * @param string $userId
     * @return FollowMessage|Promise<FollowMessage>
     */
    public function follow(string $userId)
    {
        return $this->getClient()->follow($userId);
    }

    /**
     * Unfollow a user by user id.
     *
     * @param string $userId
     * @return FollowMessage|Promise<FollowMessage>
     */
    public function unfollow(string $userId)
    {
        return $this->getClient()->unfollow($userId);
    }

    /**
     * Returns list of followers.
     *
     * @param string      $userId
     * @param string|null $maxId
     * @return FollowersMessage|Promise<FollowersMessage>
     */
    public function followers(string $userId, ?string $maxId = null)
    {
        return $this->getClient()->followers($userId, $maxId);
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
