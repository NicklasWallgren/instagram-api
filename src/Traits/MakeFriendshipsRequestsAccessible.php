<?php

declare(strict_types=1);

namespace Instagram\SDK\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\Responses\Friendships\FollowersResponse;
use Instagram\SDK\Response\Responses\Friendships\FollowingResponse;
use Instagram\SDK\Response\Responses\Friendships\FollowResponse;
use Instagram\SDK\Utils\PromiseUtils;

/**
 * Trait MakeFriendshipsRequestsAccessible
 *
 * @package Instagram\SDK\Traits
 */
trait MakeFriendshipsRequestsAccessible
{

    /**
     * Follow a user by user id.
     *
     * @param string $userId
     * @return FollowResponse
     * @throws InstagramException in case of an error
     */
    public function follow(string $userId): FollowResponse
    {
        return PromiseUtils::wait($this->followPromise($userId));
    }

    /**
     * Follow a user by user id.
     *
     * @param string $userId
     * @return PromiseInterface<FollowResponse|FollowResponse>
     */
    public function followPromise(string $userId): PromiseInterface
    {
        return $this->getClient()->follow($userId);
    }

    /**
     * Unfollow a user by user id.
     *
     * @param string $userId
     * @return FollowResponse
     * @throws InstagramException in case of an error
     */
    public function unfollow(string $userId): FollowResponse
    {
        return PromiseUtils::wait($this->unfollowPromise($userId));
    }

    /**
     * Unfollow a user by user id.
     *
     * @param string $userId
     * @return PromiseInterface<FollowResponse|InstagramException>
     */
    public function unfollowPromise(string $userId): PromiseInterface
    {
        return $this->getClient()->unfollow($userId);
    }

    /**
     * Return list of followers.
     *
     * @param string      $userId
     * @param string|null $maxId
     * @return FollowersResponse
     * @throws InstagramException in case of an error
     */
    public function followers(string $userId, ?string $maxId = null): FollowersResponse
    {
        return PromiseUtils::wait($this->getClient()->followers($userId, $maxId));
    }

    /**
     * Return list of followers.
     *
     * @param string      $userId
     * @param string|null $maxId
     * @return PromiseInterface<FollowersResponse|InstagramException>
     */
    public function followersPromise(string $userId, ?string $maxId = null): PromiseInterface
    {
        return $this->getClient()->followers($userId, $maxId);
    }

    /**
     * Return list of following users.
     *
     * @param string      $userId
     * @param string|null $maxId
     * @return FollowingResponse
     * @throws InstagramException in case of an error
     */
    public function following(string $userId, ?string $maxId = null): FollowingResponse
    {
        return PromiseUtils::wait($this->getClient()->following($userId, $maxId));
    }

    /**
     * Return list of following users.
     *
     * @param string      $userId
     * @param string|null $maxId
     * @return PromiseInterface<FollowingResponse|InstagramException>
     */
    public function followingPromise(string $userId, ?string $maxId = null): PromiseInterface
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
