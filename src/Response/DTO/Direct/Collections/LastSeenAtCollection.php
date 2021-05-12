<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Direct\Collections;

use Instagram\SDK\Response\DTO\Direct\LastSeenAt;

/**
 * Class LastSeenAtCollection
 *
 * @package Instagram\SDK\Response\DTO\Direct\Collections
 */
final class LastSeenAtCollection
{

    /** @var LastSeenAt[] */
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
        if (isset($this->items[$userId])) {
            return $this->items[$userId];
        }

        return null;
    }

    /**
     * Returns true if exists, false otherwise.
     *
     * @param string $userId
     * @return bool
     */
    public function exists(string $userId): bool
    {
        if (isset($this->items[$userId])) {
            return true;
        }

        return false;
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
