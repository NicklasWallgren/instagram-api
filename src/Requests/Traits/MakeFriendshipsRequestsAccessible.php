<?php

namespace Instagram\SDK\Requests\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Messages\Friendships\FollowersMessage;
use Instagram\SDK\DTO\Messages\Friendships\FollowingMessage;
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
    public function follow(string $userId): FollowMessage
    {
        return $this->follow($userId);
    }

    /**
     * Follow a user by user id.
     *
     * @param string $userId
     * @return PromiseInterface<FollowMessage>
     */
    public function followPromise(string $userId): PromiseInterface
    {
        return $this->getClient()->follow($userId);
    }

    /**
     * Unfollow a user by user id.
     *
     * @param string $userId
     * @return FollowMessage|PromiseInterface<FollowMessage>
     */
    public function unfollow(string $userId)
    {
        return $this->getClient()->unfollow($userId)->wait();
    }

    /**
     * Returns list of followers.
     *
     * @param string      $userId
     * @param string|null $maxId
     * @return FollowersMessage|PromiseInterface<FollowersMessage>
     */
    public function followers(string $userId, ?string $maxId = null)
    {
        return $this->getClient()->followers($userId, $maxId);
    }

    /**
     * Returns list of following users.
     *
     * @param string      $userId
     * @param string|null $maxId
     * @return FollowingMessage|PromiseInterface<FollowingMessage>
     */
    public function following(string $userId, ?string $maxId = null)
    {
        return $this->getClient()->following($userId, $maxId);
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    abstract protected function getClient(): Client;
}
