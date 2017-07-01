<?php

namespace Instagram\SDK\DTO\Session;

use Instagram\SDK\DTO\Interfaces\UserInterface;

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
    protected $isVerified;

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
     * @return mixed
     */
    public function getPrivate()
    {
        return $this->private;
    }

    /**
     * @return mixed
     */
    public function getPictureUrl()
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
     * @return mixed
     */
    public function getIsVerified()
    {
        return $this->isVerified;
    }

    /**
     * @return mixed
     */
    public function getHasAnonymousProfilePicture()
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
