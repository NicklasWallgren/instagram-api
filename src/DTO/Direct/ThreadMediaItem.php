<?php

namespace Instagram\SDK\DTO\Direct;

use Instagram\SDK\DTO\General\MediaType;

class ThreadMediaItem
{

    /**
     * @var int
     * @name media_type
     */
    protected $mediaType;

    /**
     * @var \Instagram\SDK\DTO\General\Media\ImageVersions2
     * @name image_versions2
     */
    protected $images;

    /**
     * @var
     * @name video_versions
     */
    protected $videoVersions;

    /**
     * @var int
     * @name original_width
     */
    protected $originalWidth;

    /**
     * @var int
     * @name original_height
     */
    protected $originalHeight;

    /**
     * @return mixed
     */
    public function getMediaType(): string
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
