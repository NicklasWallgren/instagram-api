<?php

namespace Instagram\SDK\DTO\Direct;

use Instagram\SDK\DTO\General\MediaType;
use Tebru\Gson\Annotation\SerializedName;

/**
 * Class ThreadMediaItem
 *
 * @package Instagram\SDK\DTO\Direct
 */
class ThreadMediaItem
{

    /**
     * @var int
     */
    protected $mediaType;

    /**
     * @var \Instagram\SDK\DTO\General\Media\ImageVersions2
     * @SerializedName("image_versions2")
     */
    protected $images;

    /**
     * @var mixed // TODO
     */
    protected $videoVersions;

    /**
     * @var int
     */
    protected $originalWidth;

    /**
     * @var int
     */
    protected $originalHeight;

    /**
     * @return int
     */
    public function getMediaType(): int
    {
        return $this->mediaType;
    }

    /**
     * @return bool
     */
    public function isPhoto(): bool
    {
        return $this->mediaType === MediaType::PHOTO;
    }

    /**
     * @return bool
     */
    public function isVideo(): bool
    {
        return $this->mediaType === MediaType::VIDEO;
    }

    /**
     * @return \Instagram\SDK\DTO\General\Media\ImageVersions2
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @return mixed
     */
    public function getVideoVersions()
    {
        return $this->videoVersions;
    }

    /**
     * @return int
     */
    public function getOriginalWidth(): int
    {
        return $this->originalWidth;
    }

    /**
     * @return int
     */
    public function getOriginalHeight(): int
    {
        return $this->originalHeight;
    }
}
