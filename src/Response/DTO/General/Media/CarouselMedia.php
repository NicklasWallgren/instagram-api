<?php

namespace Instagram\SDK\Response\DTO\General\Media;

final class CarouselMedia
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $pk;

    /**
     * @var int
     */
    private $media_type;

    /**
     * @var ImageVersions2
     */
    private $image_versions2;

    /**
     * @var int
     */
    private $original_width;

    /**
     * @var int
     */
    private $original_height;

    /**
     * @var string
     */
    private $carousel_parent_id;

    /**
     * @var bool
     */
    private $can_see_insights_as_brand;

    /**
     * @var bool
     */
    private $is_commercial;

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
    public function getPk(): int
    {
        return $this->pk;
    }

    /**
     * @return int
     */
    public function getMediaType(): int
    {
        return $this->media_type;
    }

    /**
     * @return ImageVersions2
     */
    public function getImageVersions2(): ImageVersions2
    {
        return $this->image_versions2;
    }

    /**
     * @return int
     */
    public function getOriginalWidth(): int
    {
        return $this->original_width;
    }

    /**
     * @return int
     */
    public function getOriginalHeight(): int
    {
        return $this->original_height;
    }

    /**
     * @return string
     */
    public function getCarouselParentId(): string
    {
        return $this->carousel_parent_id;
    }

    /**
     * @return bool
     */
    public function isCanSeeInsightsAsBrand(): bool
    {
        return $this->can_see_insights_as_brand;
    }

    /**
     * @return bool
     */
    public function isIsCommercial(): bool
    {
        return $this->is_commercial;
    }

}
