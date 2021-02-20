<?php

namespace Instagram\SDK\DTO\General\Media;

/**
 * Class VideoVersion
 *
 * @package Instagram\SDK\DTO\General\Media
 */
final class VideoVersion
{

    /**
     * @var int
     */
    private $type;

    /**
     * @var float
     */
    private $width;

    /**
     * @var float
     */
    private $height;

    /**
     * @var string
     */
    private $url;

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
