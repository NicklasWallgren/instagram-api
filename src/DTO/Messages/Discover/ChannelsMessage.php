<?php

namespace Instagram\SDK\DTO\Messages\Discover;

use Instagram\SDK\DTO\Envelope;

/**
 * Class ChannelsMessage
 *
 * @package Instagram\SDK\DTO\Messages\Discover
 */
final class ChannelsMessage extends Envelope
{

    /**
     * @var bool
     */
    private $autoLoadMoreEnabled;

    /**
     * @var mixed
     */
    private $items;

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
