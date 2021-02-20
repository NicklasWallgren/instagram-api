<?php

namespace Instagram\SDK\DTO\Media;

use Instagram\SDK\DTO\General\User;
use Tebru\Gson\Annotation\SerializedName;

/**
 * Class Comment
 *
 * @package Instagram\SDK\DTO\Media
 */
final class Comment
{

    /**
     * @var int
     * @SerializedName("pk")
     */
    private $id;

    /**
     * @var string
     */
    private $contentType;

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $text;

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @var int
     */
    private $createdAtUTC;

    /**
     * @var int
     */
    private $mediaId;

    /**
     * @var string
     */
    private $status;

    /**
     * @var bool
     */
    private $shareEnabled;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
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
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getCreatedAtUTC(): int
    {
        return $this->createdAtUTC;
    }

    /**
     * @return int
     */
    public function getMediaId(): int
    {
        return $this->mediaId;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function getShareEnabled(): bool
    {
        return $this->shareEnabled;
    }
}
