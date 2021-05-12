<?php

declare(strict_types=1);

namespace Instagram\SDK\Response\DTO\Direct;

use GuzzleHttp\Promise\PromiseInterface;
use Instagram\SDK\Response\DTO\Adapters\OnDecodeContext;
use Instagram\SDK\Response\DTO\Interfaces\UserInterface;
use Instagram\SDK\Response\DTO\Interactive;
use Instagram\SDK\Response\Responses\Direct\SeenResponse;
use Instagram\SDK\Response\Serializers\Interfaces\OnResponseDecodeInterface;

/**
 * Class ThreadItem
 *
 * @package Instagram\SDK\Response\DTO\Direct
 */
final class ThreadItem extends Interactive implements OnResponseDecodeInterface
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
     * @return string
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
     * @see \Instagram\SDK\Response\DTO\General\ItemType
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
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
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
     * @return PromiseInterface<SeenResponse>
     */
    public function seen()
    {
        return $this->client->seen($this->parent->getThreadId(), $this->getItemId());
    }

    /**
     * @inheritDoc
     * @param OnDecodeContext $context
     */
    public function onDecode(OnDecodeContext $context): void
    {
        $this->client = $context->getClient();
    }
}
