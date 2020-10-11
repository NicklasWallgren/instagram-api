<?php

namespace Instagram\SDK\DTO\Messages\Discover;

use Instagram\SDK\DTO\Envelope;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;

/**
 * Class ExploreMessage
 *
 * @package Instagram\SDK\DTO\Messages\Discover
 */
class ExploreMessage extends Envelope
{

    use OnPropagateDecodeEventTrait;

    /**
     * @var int
     */
    private $numResults;

    /**
     * @var bool
     */
    private $autoLoadMoreEnabled;

    /**
     * @var array<\stdClass> // TODO, define DTO class
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
     * @var string
     */
    private $maxId;

    /**
     * @var string
     */
    private $rankToken;

    /**
     * @return mixed
     */
    public function getNumResults()
    {
        return $this->numResults;
    }

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
    public function getItems(): array
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

    /**
     * @return mixed
     */
    public function getMaxId()
    {
        return $this->maxId;
    }

    /**
     * @return mixed
     */
    public function getRankToken()
    {
        return $this->rankToken;
    }
}
