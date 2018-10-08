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

    use MappableTrait;
    use OnPropagateDecodeEventTrait;

    /**
     * @var bool
     * @name auto_load_more_enabled
     */
    protected $autoLoadMoreEnabled;

    /**
     * @var mixed
     */
    protected $items;

    /**
     * @var bool
     * @name more_available
     */
    protected $moreAvailable;

    /**
     * @var string
     * @name next_max_id
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
