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
     */
    private $pictureUrl;

    /**
     * @var string
     */
    private $pictureId;

    /**
     * @var bool
     */
    private $isVerified;

    /**
     * @var bool
     */
    private $hasAnonymousProfilePicture;

    /**
     * @var bool
     */
    private $allowContactsSync;

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
