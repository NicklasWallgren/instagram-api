<?php

namespace Instagram\SDK\DTO\General;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\Interfaces\UserInterface;
use Instagram\SDK\DTO\Messages\Feed\FeedMessage;
use Instagram\SDK\DTO\Messages\Friendships\FollowersMessage;
use Instagram\SDK\DTO\Messages\Friendships\FollowMessage;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Instagram\SDK\Support\Promise;
use Tebru\Gson\Annotation\SerializedName;

/**
 * Class User
 *
 * @package Instagram\SDK\DTO\General
 */
class User implements UserInterface, OnItemDecodeInterface
{

    use OnPropagateDecodeEventTrait;

    /**
     * @var string
     * @SerializedName("pk")
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var bool
     */
    private $isPrivate;

    /**
     * @var string
     * @SerializedName("profile_pic_url")
     */
    private $profilePictureUrl;

    /**
     * @var FriendshipStatus
     */
    private $friendshipStatus;

    /**
     * @var bool
     */
    private $isVerified;

    /**
     * @var bool
     */
    private $hasAnonymousProfilePicture;

    /**
     * @var Client
     */
    private $client;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this->isPrivate;
    }

    /**
     * @return string
     */
    public function getProfilePictureUrl(): string
    {
        return $this->profilePictureUrl;
    }

    /**
     * @return FriendshipStatus
     */
    public function getFriendshipStatus()
    {
        return $this->friendshipStatus;
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    /**
     * @return bool
     */
    public function hasAnonymousProfilePicture(): bool
    {
        return $this->hasAnonymousProfilePicture;
    }

    /**
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter
     * @suppress PhanPossiblyNullTypeMismatchProperty
     * @param array<string, mixed> $container
     */
    public function onDecode(array $container): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }

    /**
     * Returns the user feed.
     *
     * @return FeedMessage
     * @throws Exception
     */
    public function feed(): FeedMessage
    {
        return $this->client->feedByUser($this->id)->wait();
    }

    /**
     * Returns the user feed.
     *
     * @return PromiseInterface<FeedMessage>
     */
    public function feedPromise(): PromiseInterface
    {
        return $this->client->feedByUser($this->id);
    }

    /**
     * Follow the user.
     *
     * @return FollowMessage
     */
    public function follow(): FollowMessage
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->client->follow($this->id)->wait();
    }

    /**
     * Follow the user.
     *
     * @return PromiseInterface<FollowMessage>
     */
    public function followPromise(): PromiseInterface
    {
        return $this->client->follow($this->id);
    }

    /**
     * Unfollow the user.
     *
     * @return FollowMessage|Promise<FollowMessage>
     */
    public function unfollow()
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->client->unfollow($this->id)->wait();
    }

    /**
     * Unfollow the user.
     *
     * @return PromiseInterface<FollowMessage>
     */
    public function unfollowPromise(): PromiseInterface
    {
        return $this->client->unfollow($this->id);
    }

    /**
     * Returns a list of followers.
     *
     * @return FollowersMessage
     */
    public function followers(): FollowersMessage
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return $this->client->followers($this->id)->wait();
    }

    /**
     * Returns a list of followers.
     *
     * @return PromiseInterface<FollowersMessage>
     */
    public function followersPromise(): PromiseInterface
    {
        return $this->client->followers($this->id);
    }
}
