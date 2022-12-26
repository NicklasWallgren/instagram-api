<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Notes;

use Instagram\SDK\Response\DTO\General\User;

/**
 * Class Note
 *
 * @package Instagram\SDK\Payloads\Notes
 */
final class Note
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var User
     */
    private $user;

    /**
     * @var int
     */
    private $audience;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @var int
     */
    private $expiresAt;

    /**
     * @var bool
     */
    private $isEmojiOnly;

    /**
     * @var bool
     */
    private $hasTranslation;

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
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getAudience(): int
    {
        return $this->audience;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getExpiresAt(): int
    {
        return $this->expiresAt;
    }

    /**
     * @return bool
     */
    public function isEmojiOnly(): bool
    {
        return $this->isEmojiOnly;
    }

    /**
     * @return bool
     */
    public function getHasTranslation(): bool
    {
        return $this->hasTranslation;
    }
}
