<?php

namespace Instagram\SDK\DTO\Media;

/**
 * Class Comment
 *
 * @package Instagram\SDK\DTO\Media
 */
class Comment
{

    /**
     * @var string
     */
    private $contentType;

    /**
     * @var \Instagram\SDK\DTO\General\User
     */
    private $user;

    /**
     * @var int
     */
    private $pk;

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
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return \Instagram\SDK\DTO\General\User
     */
    public function getUser(): \Instagram\SDK\DTO\General\User
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getPk(): int
    {
        return $this->pk;
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
