<?php

namespace Instagram\SDK\DTO\Direct;

/**
 * Class LastSeenAt
 *
 * @package Instagram\SDK\DTO\Direct
 */
class LastSeenAt
{

    /**
     * @var string
     */
    private $timestamp;

    /**
     * @var string
     */
    private $itemId;

    /**
     * LastSeenAt constructor.
     *
     * @param string $timestamp
     * @param string $itemId
     */
    public function __construct(string $timestamp, string $itemId)
    {
        $this->timestamp = $timestamp;
        $this->itemId = $itemId;
    }

    /**
     * Returns the timestamp.
     *
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * Returns the item id.
     *
     * @return string
     */
    public function getItemId(): string
    {
        return $this->itemId;
    }
}
