<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Hashtag;

use Instagram\SDK\Response\DTO\General\Media\Caption;
use Instagram\SDK\Response\DTO\General\Media\CarouselMedia;
use Instagram\SDK\Response\DTO\General\Media\ImageVersions2;
use Instagram\SDK\Response\DTO\General\Media\Location;
use Instagram\SDK\Response\DTO\General\Media\VideoVersion;
use Instagram\SDK\Response\DTO\General\User;

/**
 * Class Item
 *
 * @package Instagram\SDK\Response\DTO\Hashtag
 */
final class Item
{
    /**
     * @var float
     */
    private $pk;

    /**
     * @var int
     */
    private $takenAt;

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
     * @var ImageVersions2[]|null
     */
    private $imageVersions2;

    /**
     * @var CarouselMedia[]|null
     */
    private $carousel_media;

    /**
     * @var float
     */
    private $originalWidth;

    /**
     * @var float
     */
    private $originalHeight;

    /**
     * @var VideoVersion[]|null
     */
    private $videoVersions;

    /**
     * @var bool
     */
    private $hasAudio;

    /**
     * @var int|null
     */
    private $videoDuration;

    /**
     * @var int|null
     */
    private $viewCount;

    /**
     * @var Location|null
     */
    private $location;

    /**
     * @var float|null
     */
    private $lng;

    /**
     * @var float|null
     */
    private $lat;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Caption
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
     * @return ImageVersions2[]
     */
    public function getImageVersions2(): ?array
    {
        return $this->imageVersions2;
    }

    /**
     * @return CarouselMedia[]
     */
    public function getCarouselMedia(): ?array
    {
        return $this->carousel_media;
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
     * @return VideoVersion[]|null
     */
    public function getVideoVersions(): ?array
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
     * @return Location|null
     */
    public function getLocation(): ?Location
    {
        return $this->location;
    }

    /**
     * @return float|null
     */
    public function getLng(): ?float
    {
        return $this->lng;
    }

    /**
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Caption
     */
    public function getCaption(): Caption
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
}
