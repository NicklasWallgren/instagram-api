<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Interfaces;

/**
 * Interface UserInterface
 *
 * @package Instagram\SDK\Payloads\Interfaces
 */
interface UserInterface
{

    /**
     * Returns the id.
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Returns the username.
     *
     * @return string
     */
    public function getUsername(): string;

    /**
     * Returns the fullname.
     *
     * @return string|null
     */
    public function getFullname(): ?string;

    /**
     * Returns true if the profile is private, false otherwise.
     *
     * @return bool
     */
    public function isPrivate(): bool;

    /**
     * Returns the profile picture url.
     *
     * @return string
     */
    public function getProfilePictureUrl(): string;

    /**
     * Returns true if the profile has a anonymous profile picture, false otherwise.
     *
     * @return bool
     */
    public function hasAnonymousProfilePicture(): bool;

    /**
     * Returns true if verified, false otherwise.
     *
     * @return bool
     */
    public function isVerified(): bool;
}
