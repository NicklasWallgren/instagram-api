<?php

namespace Instagram\SDK\DTO\Direct;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\DTO;
use Instagram\SDK\DTO\Interactive;
use Instagram\SDK\DTO\Interfaces\UserInterface;
use Instagram\SDK\DTO\Messages\Direct\SeenMessage;
use Instagram\SDK\Responses\Serializers\Interfaces\OnDecodeInterface;
use Instagram\SDK\Support\Promise;

/**
 * Class ThreadItem
 *
 * @package Instagram\SDK\DTO\Direct
 */
final class ThreadItem extends Interactive implements OnDecodeInterface
{

    /**
     * @var Thread
     */
    private $parent;

    /**
     * @var string
     */
    private $itemId;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var double
     */
    private $timestamp;

    /**
     * @var string
     */
    private $itemType;

    /**
     * @var ThreadMediaItem
     */
    private $media;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $clientContext;

    /**
     * @return string
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * Returns the user.
     *
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * @return float
     */
    public function getTimestamp(): float
    {
        return $this->timestamp;
    }

    /**
     * @return mixed
     */
    public function getItemType()
    {
        return $this->itemType;
    }

    /**
     * Returns true if the provided type matches the item type.
     *
     * @param string $type
     * @return bool
     * @see \Instagram\SDK\DTO\General\ItemType
     */
    public function isItemType(string $type): bool
    {
        return $type === $this->itemType;
    }

    /**
     * @return ThreadMediaItem
     */
    public function getMedia(): ThreadMediaItem
    {
        return $this->media;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getClientContext()
    {
        return $this->clientContext;
    }

    /**
     * @return Thread
     */
    public function getParent(): Thread
    {
        return $this->parent;
    }

    /**
     * Sets the thread item as seen.
     *
     * @return SeenMessage|Promise<SeenMessage>
     */
    public function seen()
    {
        return $this->client->seen($this->parent->getThreadId(), $this->getItemId());
    }

    /**
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter, PhanPossiblyNullTypeMismatchProperty
     * @param array<string, mixed> $container
     */
    public function onDecode(array $container): void
    {
        $this->client = $container['client'];
    }
}
