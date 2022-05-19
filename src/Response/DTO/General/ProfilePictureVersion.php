<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\General;

/**
 * Class ProfilePictureVersion
 *
 * @package Instagram\SDK\Payloads\General
 */
final class ProfilePictureVersion
{

    private int $width;

    private int $height;

    private string $url;

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
