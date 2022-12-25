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
    private $user_id;

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
    private $created_at;

    /**
     * @var int
     */
    private $expires_at;

    /**
     * @var bool
     */
    private $is_emoji_only;

    /**
     * @var bool
     */
    private $has_translation;

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
        return $this->user_id;
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
        return $this->created_at;
    }

    /**
     * @return int
     */
    public function getExpiresAt(): int
    {
        return $this->expires_at;
    }

    /**
     * @return bool
     */
    public function isEmojiOnly(): bool
    {
        return $this->is_emoji_only;
    }

    /**
     * @return bool
     */
    public function getHasTranslation(): bool
    {
        return $this->has_translation;
    }
}
