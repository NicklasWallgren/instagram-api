<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\General\Media;

/**
 * Class Image
 *
 * @package Instagram\SDK\Payloads\General\Media
 */
final class Image
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
     * @return string
     */
    public function getWidth(): string
    {
        return $this->width;
    }

    /**
     * @return string
     */
    public function getHeight(): string
    {
        return $this->height;
    }
}
