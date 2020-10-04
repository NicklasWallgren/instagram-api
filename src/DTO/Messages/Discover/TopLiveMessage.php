<?php

namespace Instagram\SDK\DTO\Messages\Discover;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Traits\MappableTrait;

/**
 * Class TopLiveMessage
 *
 * @package Instagram\SDK\DTO\Messages\Discover
 */
class TopLiveMessage extends Envelope
{

    use OnPropagateDecodeEventTrait;

    /**
     * @var bool
     */
    protected $autoLoadMoreEnabled;

    /**
     * @var array<\stdClass> // TODO, define DTO class
     */
    protected $broadcasts;

    /**
     * @var bool
     */
    protected $moreAvailable;

    /**
     * @var string
     */
    protected $nextMaxId;

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
