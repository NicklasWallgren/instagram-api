<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\General\Media;

/**
 * Class ImageVersions2
 *
 * @package Instagram\SDK\Payloads\General\Media
 */
final class ImageVersions2
{

    /**
     * @var Image[]
     */
    private $candidates;

    /**
     * @return Image[]
     */
    public function getCandidates()
    {
        return $this->candidates;
    }
}
