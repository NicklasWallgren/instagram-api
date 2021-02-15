<?php

namespace Instagram\SDK\DTO\General\Media;

/**
 * Class Image
 *
 * @package Instagram\SDK\DTO\General\Media
 */
class Image
{

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $width;

    /**
     * @var string
     */
    private $height;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }
}
