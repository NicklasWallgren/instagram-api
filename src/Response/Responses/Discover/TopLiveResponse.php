<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Discover;

use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Class TopLiveResponse
 *
 * @package Instagram\SDK\Response\Responses\Discover
 */
final class TopLiveResponse extends ResponseEnvelope
{

    /** @var bool */
    private $autoLoadMoreEnabled;

    /** @var array<\stdClass> */
    private $broadcasts;

    /** @var bool */
    private $moreAvailable;

    /** @var string */
    private $nextMaxId;

    /**
     * @return bool
     */
    public function getAutoLoadMoreEnabled()
    {
        return $this->autoLoadMoreEnabled;
    }

    /**
     * @return array<\stdClass>
     */
    public function getBroadcasts(): array
    {
        return $this->broadcasts;
    }

    /**
     * @return bool
     */
    public function getMoreAvailable(): bool
    {
        return $this->moreAvailable;
    }

    /**
     * @return string
     */
    public function getNextMaxId(): string
    {
        return $this->nextMaxId;
    }
}
