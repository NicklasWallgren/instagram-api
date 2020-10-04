<?php

namespace Instagram\SDK\DTO\Direct;

use Instagram\SDK\Client\Client;
use Instagram\SDK\DTO\DTO;
use Instagram\SDK\DTO\Interfaces\UserInterface;
use Instagram\SDK\DTO\Messages\Direct\SeenMessage;
use Instagram\SDK\Responses\Serializers\Interfaces\OnDecodeRequirementsInterface;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Support\Promise;

/**
 * Class ThreadItem
 *
 * @package Instagram\SDK\DTO\Direct
 */
class ThreadItem extends DTO implements OnItemDecodeInterface, OnDecodeRequirementsInterface
{

    /**
     * @var Thread
     */
    protected $parent;

    /**
     * @var string
     */
    protected $itemId;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var double
     */
    protected $timestamp;

    /**
     * @var string
     */
    protected $itemType;

    /**
     * @var ThreadMediaItem
     */
    protected $media;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $clientContext;

    /**
     * @var Client
     */
    protected $client;

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
     * Sets the user.
     *
     * @param UserInterface $user
     * @return $this
     */
    public function setUser(UserInterface $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return float
     */
    public function getTimestamp(): float
    {
        return $this->timestamp;
    }

    // timestamp to date

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
     * @see \Instagram\SDK\DTO\General\ItemType
     * @param string $type
     * @return bool
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
     * @param Thread $parent
     * @return static
     */
    public function setParent(Thread $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @param mixed $itemId
     * @return static
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * @param mixed $userId
     * @return static
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @param float $timestamp
     * @return static
     */
    public function setTimestamp(float $timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @param mixed $itemType
     * @return static
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;

        return $this;
    }

    /**
     * @param ThreadMediaItem $media
     * @return static
     */
    public function setMedia(ThreadMediaItem $media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * @param mixed $text
     * @return static
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param mixed $clientContext
     * @return static
     */
    public function setClientContext($clientContext)
    {
        $this->clientContext = $clientContext;

        return $this;
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
     * @param array<string, string> $requirements
     */
    public function onDecode(array $container, $requirements = []): void
    {
        $this->client = $container['client'];
    }

    /**
     * Returns the requirements.
     *
     * @return string[]
     */
    public function requirements(): array
    {
        return ['user:userId', 'parent'];
    }
}
