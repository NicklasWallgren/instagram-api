<?php

namespace Instagram\SDK\DTO\Session;

use Instagram\SDK\DTO\Interfaces\UserInterface;
use Tebru\Gson\Annotation\SerializedName;

/**
 * Class User
 *
 * @package Instagram\SDK\DTO\Session
 */
class User implements UserInterface
{

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
     */
    protected $pictureUrl;

    /**
     * @var string
     */
    protected $pictureId;

    /**
     * @var bool
     */
    protected $isVerified;

    /**
     * @var bool
     */
    protected $hasAnonymousProfilePicture;

    /**
     * @var bool
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
        return $this->isPrivate;
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
     * @return mixed
     */
    public function getAllowContactsSync()
    {
        return $this->allowContactsSync;
    }
}
