<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\General;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Client\Client;
use Instagram\SDK\Exceptions\InstagramException;
use Instagram\SDK\Response\DTO\Adapters\OnDecodeContext;
use Instagram\SDK\Response\DTO\Interfaces\UserInterface;
use Instagram\SDK\Response\Responses\Feed\FeedResponse;
use Instagram\SDK\Response\Responses\Friendships\FollowersResponse;
use Instagram\SDK\Response\Responses\Friendships\FollowResponse;
use Instagram\SDK\Response\Serializers\Interfaces\OnResponseDecodeInterface;
use Instagram\SDK\Utils\PromiseUtils;
use Tebru\Gson\Annotation\SerializedName;

/**
 * Class User
 *
 * @package Instagram\SDK\Response\DTO\General
 */
final class User implements UserInterface, OnResponseDecodeInterface
{

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
     * @var ProfilePictureVersion[]
     * @SerializedName("hd_profile_pic_versions")
     */
    private $profilePictureVersions;

    /**
     * @var ProfilePictureVersion
     * @SerializedName("hd_profile_pic_url_info")
     */
    private $profilePictureUrlInfo;

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
     * @var int
     */
    private $followerCount;

    /**
     * @var int
     */
    private $followingCount;

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
     * @return int
     */
    public function getFollowerCount(): int
    {
        return $this->followerCount;
    }

    /**
     * @return int
     */
    public function getFollowingCount(): int
    {
        return $this->followingCount;
    }

    /**
     * @inheritDoc
     */
    public function onDecode(OnDecodeContext $context): void
    {
        $this->client = $context->getClient();
    }

    /**
     * Returns the user feed.
     *
     * @return FeedResponse
     * @throws InstagramException
     */
    public function feed(): FeedResponse
    {
        return PromiseUtils::wait($this->client->feedByUser($this->id));
    }

    /**
     * Returns the user feed.
     *
     * @return PromiseInterface<FeedResponse|InstagramException>
     */
    public function feedPromise(): PromiseInterface
    {
        return $this->client->feedByUser($this->id);
    }

    /**
     * Follow the user.
     *
     * @return FollowResponse
     * @throws InstagramException
     */
    public function follow(): FollowResponse
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->client->follow($this->id));
    }

    /**
     * Follow the user.
     *
     * @return PromiseInterface<FollowResponse>
     */
    public function followPromise(): PromiseInterface
    {
        return $this->client->follow($this->id);
    }

    /**
     * Unfollow the user.
     *
     * @return FollowResponse
     * @throws InstagramException
     */
    public function unfollow(): FollowResponse
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->client->unfollow($this->id));
    }

    /**
     * Unfollow the user.
     *
     * @return PromiseInterface<FollowResponse|InstagramException>
     */
    public function unfollowPromise(): PromiseInterface
    {
        return $this->client->unfollow($this->id);
    }

    /**
     * Returns a list of followers.
     *
     * @return FollowersResponse
     * @throws InstagramException
     */
    public function followers(): FollowersResponse
    {
        // @phan-suppress-next-line PhanThrowTypeAbsentForCall
        return PromiseUtils::wait($this->client->followers($this->id));
    }

    /**
     * Returns a list of followers.
     *
     * @return PromiseInterface<FollowersResponse|InstagramException>
     */
    public function followersPromise(): PromiseInterface
    {
        return $this->client->followers($this->id);
    }
}
