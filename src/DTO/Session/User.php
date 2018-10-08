<?php

namespace Instagram\SDK\DTO\Session;

use Instagram\SDK\DTO\Interfaces\UserInterface;

/**
 * Class User
 *
 * @package Instagram\SDK\DTO\Session
 */
class User implements UserInterface
{

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
    protected $pictureUrl;

    /**
     * @var string
     * @name profile_pic_id
     */
    protected $pictureId;

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
     * @var bool
     * @name allow_contacts_sync
     */
    protected $allowContactsSync;

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
        return $this->pictureUrl;
    }

    /**
     * @return mixed
     */
    public function getPictureId()
    {
        return $this->pictureId;
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
     * @return mixed
     */
    public function getAllowContactsSync()
    {
        return $this->allowContactsSync;
    }
}
