<?php

namespace Instagram\SDK\DTO\General;

use Exception;
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
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $fullName;

    /**
     * @var bool
     */
    protected $isPrivate;

    /**
     * @var string
     * @SerializedName("profile_pic_url")
     */
    protected $profilePictureUrl;

    /**
     * @var FriendshipStatus
     */
    protected $friendshipStatus;

    /**
     * @var bool
     */
    protected $isVerified;

    /**
     * @var int
     */
    protected $followerCount;

    /**
     * @var bool
     */
    protected $hasAnonymousProfilePicture;

    /**
     * @var Client
     */
    protected $client;

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
     * @return int
     */
    public function followerCount(): bool
    {
        return $this->followerCount;
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
     * @param array<string, mixed>  $container
     */
    public function onDecode(array $container): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }

    /**
     * Returns the user feed.
     *
     * @return FeedMessage|Promise<FeedMessage>
     * @throws Exception
     */
    public function feed()
    {
        return $this->client->feedByUser($this->id);
    }

    /**
     * Follow the user.
     *
     * @return FollowMessage|Promise<FollowMessage>
     */
    public function follow()
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
        return $this->client->unfollow($this->id);
    }

    /**
     * Returns a list of followers.
     *
     * @return FollowersMessage|Promise<FollowersMessage>
     */
    public function followers()
    {
        return $this->client->followers($this->id);
    }
}
