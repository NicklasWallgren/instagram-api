<?php

namespace Instagram\SDK\DTO\Messages\Discover;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Traits\MappableTrait;

/**
 * Class ChannelsMessage
 *
 * @package Instagram\SDK\DTO\Messages\Discover
 */
class ChannelsMessage extends Envelope
{

    use OnPropagateDecodeEventTrait;

    /**
     * @var bool
     */
    protected $autoLoadMoreEnabled;

    /**
     * @var mixed
     */
    protected $items;

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
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
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
