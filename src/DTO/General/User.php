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
     * @name pk
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     * @name full_name
     */
    protected $fullName;

    /**
     * @var bool
     * @name is_private
     */
    protected $private;

    /**
     * @var string
     * @name profile_pic_url
     */
    protected $profilePictureUrl;

    /**
     * @var \Instagram\SDK\DTO\General\FriendshipStatus
     * @name friendship_status
     */
    protected $friendshipStatus;

    /**
     * @var bool
     * @name is_verified
     */
    protected $verified;

    /**
     * @var bool
     * @name has_anonymous_profile_picture
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
        return $this->private;
    }

    /**
     * @return string
     */
    public function getProfilePictureUrl(): string
    {
        return $this->profilePictureUrl;
    }

    /**
     * @return mixed
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
        return $this->verified;
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
     * @param array<string, string> $requirements
     * @throws Exception
     */
    public function onDecode(array $container, $requirements = []): void
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
