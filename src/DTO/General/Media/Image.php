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
    protected $url;

    /**
     * @var string
     */
    protected $width;

    /**
     * @var string
     */
    protected $height;

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
