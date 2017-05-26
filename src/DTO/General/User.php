<?php

namespace NicklasW\Instagram\DTO\General;

use NicklasW\Instagram\DTO\Interfaces\UserInterface;

class User implements UserInterface
{

    /**
     * @var int
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
    protected $isPrivate;

    /**
     * @var string
     * @name profile_pic_url
     */
    protected $profilePicUrl;

    /**
     * @var object
     * @name friendship_status
     */
    protected $friendshipStatus;

    /**
     * @var bool
     * @name is_verified
     */
    protected $isVerified;

    /**
     * @var bool
     * @name has_anonymous_profile_picture
     */
    protected $hasAnonymousProfilePicture;

    /**
     * @return int
     */
    public function getId(): int
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
    public function isIsPrivate(): bool
    {
        return $this->isPrivate;
    }

    /**
     * @return string
     */
    public function getProfilePicUrl(): string
    {
        return $this->profilePicUrl;
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
    public function isIsVerified(): bool
    {
        return $this->isVerified;
    }

    /**
     * @return bool
     */
    public function isHasAnonymousProfilePicture(): bool
    {
        return $this->hasAnonymousProfilePicture;
    }

}