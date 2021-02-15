<?php

namespace Instagram\SDK\DTO\Direct\Collections;

use Instagram\SDK\DTO\Direct\LastSeenAt;

/**
 * Class LastSeenAtCollection
 *
 * @package Instagram\SDK\DTO\Direct\Collections
 */
class LastSeenAtCollection
{

    /**
     * @var LastSeenAt[]
     */
    private $items = [];

    /**
     * LastSeenAtCollection constructor.
     *
     * @param LastSeenAt[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Returns the @code LastSeenAt item, if exists.
     *
     * @param int $userId
     * @return LastSeenAt|null
     */
    public function get(int $userId): ?LastSeenAt
    {
        return @$this->items[$userId];
    }

    /**
     * Returns true if exists, false otherwise.
     *
     * @param string $userId
     * @return bool
     */
    public function exists(string $userId): bool
    {
        return @$this->items[$userId] !== null;
    }

    /**
     * Returns the items.
     *
     * @return LastSeenAt[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
