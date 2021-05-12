<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Discover;

use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Class ChannelsResponse
 *
 * @package Instagram\SDK\Response\Responses\Discover
 */
final class ChannelsResponse extends ResponseEnvelope
{

    /** @var bool */
    private $autoLoadMoreEnabled;

    /** @var mixed */
    private $items;

    /** @var bool  */
    private $moreAvailable;

    /** @var string|null */
    private $nextMaxId;

    /**
     * @return bool
     */
    public function getAutoLoadMoreEnabled(): bool
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
     * @return bool
     */
    public function getMoreAvailable(): bool
    {
        return $this->moreAvailable;
    }

    /**
     * @return string|null
     */
    public function getNextMaxId(): ?string
    {
        return $this->nextMaxId;
    }
}
