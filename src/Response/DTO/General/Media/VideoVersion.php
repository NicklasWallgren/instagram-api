<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\General\Media;

/**
 * Class VideoVersion
 *
 * @package Instagram\SDK\Payloads\General\Media
 */
final class VideoVersion
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var string
     */
    private $url;

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
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
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
