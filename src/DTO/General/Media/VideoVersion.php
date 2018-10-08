<?php

namespace Instagram\SDK\DTO\General\Media;

/**
 * Class VideoVersion
 *
 * @package Instagram\SDK\DTO\General\Media
 */
class VideoVersion
{

    /**
     * @var int
     */
    protected $type;

    /**
     * @var float
     */
    protected $width;

    /**
     * @var float
     */
    protected $height;

    /**
     * @var string
     */
    protected $url;

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
