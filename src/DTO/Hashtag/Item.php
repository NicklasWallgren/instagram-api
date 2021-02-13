<?php

namespace Instagram\SDK\DTO\Hashtag;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;

/**
 * Class Item
 *
 * @package Instagram\SDK\DTO\Hashtag
 */
class Item implements OnItemDecodeInterface
{

    use OnPropagateDecodeEventTrait;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var int
     */
    protected $takenAt;

    /**
     * @var float
     */
    protected $pk;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var int
     */
    protected $deviceTimestamp;

    /**
     * @var int
     */
    protected $mediaType;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $clientCacheKey;

    /**
     * @var int
     */
    protected $filterType;

    /**
     * @var \Instagram\SDK\DTO\General\Media\ImageVersions2[]
     */
    protected $imageVersions2;

    /**
     * @var float
     */
    protected $originalWidth;

    /**
     * @var float
     */
    protected $originalHeight;

    /**
     * @var object
     */
    protected $videoVersions;

    /**
     * @var bool
     */
    protected $hasAudio;

    /**
     * @var int
     */
    protected $videoDuration;

    /**
     * @var int
     */
    protected $viewCount;

    /**
     * @var object // TODO
     */
    protected $user;

    /**
     * @var object // TODO
     */
    protected $caption;

    /**
     * @var bool
     */
    protected $captionIsEdited;

    /**
     * @var int
     */
    protected $likeCount;

    /**
     * @var bool
     */
    protected $has_liked;

    /**
     * @var bool
     */
    protected $commentLikesEnabled;

    /**
     * @var bool
     */
    protected $commentThreadingEnabled;

    /**
     * @var bool
     */
    protected $hasMoreComments;

    /**
     * @var float
     */
    protected $nextMaxId;

    /**
     * @var int
     */
    protected $maxNumVisiblePreviewComments;

    /**
     * @var int
     */
    protected $commentCount;

    /**
     * @var bool
     */
    protected $photoOfYou;

    /**
     * @var bool
     */
    protected $canViewerSave;

    /**
     * @var string
     */
    protected $organicTrackingToken;

    /**
     * @return int
     */
    public function getTakenAt(): int
    {
        return $this->takenAt;
    }

    /**
     * @return float
     */
    public function getPk(): float
    {
        return $this->pk;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getDeviceTimestamp(): int
    {
        return $this->deviceTimestamp;
    }

    /**
     * @return int
     */
    public function getMediaType(): int
    {
        return $this->mediaType;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getClientCacheKey(): string
    {
        return $this->clientCacheKey;
    }

    /**
     * @return int
     */
    public function getFilterType(): int
    {
        return $this->filterType;
    }

    /**
     * @return \Instagram\SDK\DTO\General\Media\ImageVersions2[]
     */
    public function getImageVersions2(): array
    {
        return $this->imageVersions2;
    }

    /**
     * @return float
     */
    public function getOriginalWidth(): float
    {
        return $this->originalWidth;
    }

    /**
     * @return float
     */
    public function getOriginalHeight(): float
    {
        return $this->originalHeight;
    }

    /**
     * @return object
     */
    public function getVideoVersions(): object
    {
        return $this->videoVersions;
    }

    /**
     * @return bool
     */
    public function isHasAudio(): bool
    {
        return $this->hasAudio;
    }

    /**
     * @return int
     */
    public function getVideoDuration(): int
    {
        return $this->videoDuration;
    }

    /**
     * @return int
     */
    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    /**
     * @return object
     */
    public function getUser(): object
    {
        return $this->user;
    }

    /**
     * @return object
     */
    public function getCaption(): object
    {
        return $this->caption;
    }

    /**
     * @return bool
     */
    public function isCaptionIsEdited(): bool
    {
        return $this->captionIsEdited;
    }

    /**
     * @return int
     */
    public function getLikeCount(): int
    {
        return $this->likeCount;
    }

    /**
     * @return bool
     */
    public function isHasLiked(): bool
    {
        return $this->has_liked;
    }

    /**
     * @return bool
     */
    public function isCommentLikesEnabled(): bool
    {
        return $this->commentLikesEnabled;
    }

    /**
     * @return bool
     */
    public function isCommentThreadingEnabled(): bool
    {
        return $this->commentThreadingEnabled;
    }

    /**
     * @return bool
     */
    public function isHasMoreComments(): bool
    {
        return $this->hasMoreComments;
    }

    /**
     * @return float
     */
    public function getNextMaxId(): float
    {
        return $this->nextMaxId;
    }

    /**
     * @return int
     */
    public function getMaxNumVisiblePreviewComments(): int
    {
        return $this->maxNumVisiblePreviewComments;
    }

    /**
     * @return int
     */
    public function getCommentCount(): int
    {
        return $this->commentCount;
    }

    /**
     * @return bool
     */
    public function isPhotoOfYou(): bool
    {
        return $this->photoOfYou;
    }

    /**
     * @return bool
     */
    public function isCanViewerSave(): bool
    {
        return $this->canViewerSave;
    }

    /**
     * @return string
     */
    public function getOrganicTrackingToken(): string
    {
        return $this->organicTrackingToken;
    }

    /**
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter
     * @suppress PhanPossiblyNullTypeMismatchProperty
     * @param array<string, mixed> $container
     */
    public function onDecode(array $container): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }
}
