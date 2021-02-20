<?php

namespace Instagram\SDK\DTO\Messages\Discover;

use Instagram\SDK\DTO\Envelope;

/**
 * Class TopLiveMessage
 *
 * @package Instagram\SDK\DTO\Messages\Discover
 */
final class TopLiveMessage extends Envelope
{

    /**
     * @var bool
     */
    private $autoLoadMoreEnabled;

    /**
     * @var array<\stdClass> // TODO, define DTO class
     */
    private $broadcasts;

    /**
     * @var bool
     */
    private $moreAvailable;

    /**
     * @var string
     */
    private $nextMaxId;

    /**
     * @return mixed
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
     * @return mixed
     */
    public function getMoreAvailable()
    {
        return $this->moreAvailable;
    }

    /**
     * @return mixed
     */
    public function getNextMaxId()
    {
        return $this->nextMaxId;
    }
}
