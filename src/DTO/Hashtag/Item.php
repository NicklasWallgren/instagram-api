<?php

namespace Instagram\SDK\DTO\Hashtag;

use Instagram\SDK\Client\Client;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Tebru\Gson\Annotation\SerializedName;

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
    private $client;

    /**
     * @var int
     */
    private $takenAt;

    /**
     * @var float
     */
    private $pk;

    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $deviceTimestamp;

    /**
     * @var int
     */
    private $mediaType;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $clientCacheKey;

    /**
     * @var int
     */
    private $filterType;

    /**
     * @var \Instagram\SDK\DTO\General\Media\ImageVersions2[]
     */
    private $imageVersions2;

    /**
     * @var float
     */
    private $originalWidth;

    /**
     * @var float
     */
    private $originalHeight;

    /**
     * @var object
     */
    private $videoVersions;

    /**
     * @var bool
     */
    private $hasAudio;

    /**
     * @var int
     */
    private $videoDuration;

    /**
     * @var int
     */
    private $viewCount;

    /**
     * @var object // TODO
     */
    private $user;

    /**
     * @var object // TODO
     */
    private $caption;

    /**
     * @var bool
     */
    private $captionIsEdited;

    /**
     * @var int
     */
    private $likeCount;

    /**
     * @var bool
     * @SerializedName("has_liked")
     */
    private $hasLiked;

    /**
     * @var bool
     */
    private $commentLikesEnabled;

    /**
     * @var bool
     */
    private $commentThreadingEnabled;

    /**
     * @var bool
     */
    private $hasMoreComments;

    /**
     * @var float
     */
    private $nextMaxId;

    /**
     * @var int
     */
    private $maxNumVisiblePreviewComments;

    /**
     * @var int
     */
    private $commentCount;

    /**
     * @var bool
     */
    private $photoOfYou;

    /**
     * @var bool
     */
    private $canViewerSave;

    /**
     * @var string
     */
    private $organicTrackingToken;

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
        return $this->hasLiked;
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
