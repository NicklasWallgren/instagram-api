<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Direct;

use Instagram\SDK\Response\DTO\General\Media\ImageVersions2;
use Instagram\SDK\Response\DTO\General\MediaType;
use Tebru\Gson\Annotation\SerializedName;

/**
 * Class ThreadMediaItem
 *
 * @package Instagram\SDK\Response\DTO\Direct
 */
final class ThreadMediaItem
{

    /**
     * @var int
     */
    private $mediaType;

    /**
     * @var ImageVersions2
     * @SerializedName("image_versions2")
     */
    private $images;

    /**
     * @var mixed // TODO
     */
    private $videoVersions;

    /**
     * @var int
     */
    private $originalWidth;

    /**
     * @var int
     */
    private $originalHeight;

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
     * @return ImageVersions2
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
