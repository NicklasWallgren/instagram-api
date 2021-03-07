<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\Responses\Discover;

use Instagram\SDK\Response\Responses\ResponseEnvelope;

/**
 * Class ExploreMessage
 *
 * @package Instagram\SDK\Response\Responses\Discover
 */
final class ExploreResponse extends ResponseEnvelope
{

    /** @var int */
    private $numResults;

    /** @var bool  */
    private $autoLoadMoreEnabled;

    /** @var array<\stdClass> // TODO, define Payloads class */
    private $items;

    /** @var bool */
    private $moreAvailable;

    /** @var string|null */
    private $nextMaxId;

    /** @var string */
    private $maxId;

    /** @var string */
    private $rankToken;

    /**
     * @return int
     */
    public function getNumResults(): int
    {
        return $this->numResults;
    }

    /**
     * @return bool
     */
    public function isAutoLoadMoreEnabled(): bool
    {
        return $this->autoLoadMoreEnabled;
    }

    /**
     * @return \stdClass[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return bool
     */
    public function isMoreAvailable(): bool
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

    /**
     * @return string
     */
    public function getMaxId(): string
    {
        return $this->maxId;
    }

    /**
     * @return string
     */
    public function getRankToken(): string
    {
        return $this->rankToken;
    }
}
