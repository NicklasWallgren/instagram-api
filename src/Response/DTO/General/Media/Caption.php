<?php

namespace Instagram\SDK\Response\DTO\General\Media;

use Instagram\SDK\Response\DTO\General\User;

final class Caption
{
    /** @var integer */
    private $pk;

    /** @var integer */
    private $user_id;

    /** @var string */
    private $text;

    /** @var integer */
    private $type;

    /** @var integer */
    private $created_at;

    /** @var integer */
    private $created_at_utc;

    /** @var string */
    private $content_type;

    /** @var string */
    private $status;

    /** @var integer */
    private $bit_flags;

    /** @var boolean */
    private $did_report_as_spam;

    /** @var boolean */
    private $share_enabled;

    /** @var User */
    private $user;

    /** @var boolean */
    private $is_covered;

    /** @var integer */
    private $media_id;

    /** @var boolean */
    private $has_translation;

    /** @var integer */
    private $private_reply_status;

    /**
     * @return int
     */
    public function getPk(): int
    {
        return $this->pk;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
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
    public function getType(): int
    {
        return $this->type;
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
    public function getCreatedAtUtc(): int
    {
        return $this->created_at_utc;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->content_type;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getBitFlags(): int
    {
        return $this->bit_flags;
    }

    /**
     * @return bool
     */
    public function isDidReportAsSpam(): bool
    {
        return $this->did_report_as_spam;
    }

    /**
     * @return bool
     */
    public function isShareEnabled(): bool
    {
        return $this->share_enabled;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return bool
     */
    public function isIsCovered(): bool
    {
        return $this->is_covered;
    }

    /**
     * @return int
     */
    public function getMediaId(): int
    {
        return $this->media_id;
    }

    /**
     * @return bool
     */
    public function isHasTranslation(): bool
    {
        return $this->has_translation;
    }

    /**
     * @return int
     */
    public function getPrivateReplyStatus(): int
    {
        return $this->private_reply_status;
    }

}
