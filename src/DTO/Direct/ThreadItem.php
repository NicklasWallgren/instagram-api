<?php

namespace NicklasW\Instagram\DTO\Direct;

use NicklasW\Instagram\DTO\DTO;
use NicklasW\Instagram\DTO\Interfaces\UserDetailsInterface;
use NicklasW\Instagram\DTO\Interfaces\UserInterface;
use NicklasW\Instagram\Responses\Serializers\Interfaces\OnDecodeRequirementsInterface;
use NicklasW\Instagram\Responses\Serializers\Interfaces\OnItemDecodeInterface;

class ThreadItem extends DTO implements OnItemDecodeInterface, OnDecodeRequirementsInterface
{

    /**
     * @var Thread
     */
    protected $parent;

    /**
     * @var string
     * @name item_id
     */
    protected $itemId;

    /**
     * @var int
     * @name user_id
     */
    protected $userId;

    /**
     * @var UserDetailsInterface
     */
    protected $user;

    /**
     * @var double
     */
    protected $timestamp;

    /**
     * @var string
     * @name item_type
     */
    protected $itemType;

    /**
     * @var ThreadMediaItem
     */
    protected $media;

    /**
     * @var string
     * @name text
     */
    protected $text;

    /**
     * @var string
     * @name client_context
     */
    protected $clientContext;

    /**
     * @return mixed
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
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * Sets the user.
     *
     * @param UserInterface $user
     */
    public function setUser(?UserInterface $user)
    {
        $this->user = $user;
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
     * @see \NicklasW\Instagram\DTO\General\ItemType
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
     */
    public function setParent(Thread $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @param mixed $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param float $timestamp
     */
    public function setTimestamp(float $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @param mixed $itemType
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;
    }

    /**
     * @param ThreadMediaItem $media
     */
    public function setMedia(ThreadMediaItem $media)
    {
        $this->media = $media;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param mixed $clientContext
     */
    public function setClientContext($clientContext)
    {
        $this->clientContext = $clientContext;
    }

    /**
     * On item decode method.
     *
     * @param array $container
     * @param array $requirements
     */
    public function onDecode(array $container, $requirements = []): void
    {
//        $this->parent = $requirements['parent'];

//        print_r($this->getUser());


    }

    /**
     * Returns the requirements.
     *
     * @return array
     */
    public function requirements()
    {
        return ['user:userId', 'parent'];
    }

}