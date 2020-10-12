<?php

namespace Instagram\SDK\DTO\Direct;

use Instagram\SDK\DTO\Cursor\RequestIterator;
use Instagram\SDK\DTO\Direct\Collections\LastSeenAtCollection;
use Instagram\SDK\DTO\General\ItemType;
use Instagram\SDK\DTO\General\User;
use Instagram\SDK\DTO\Messages\Direct\DirectSendItemMessage;
use Instagram\SDK\DTO\Messages\Direct\SeenMessage;
use Instagram\SDK\DTO\Messages\Direct\ThreadMessage;
use Instagram\SDK\Responses\Serializers\Interfaces\OnItemDecodeInterface;
use Instagram\SDK\Responses\Serializers\Traits\OnPropagateDecodeEventTrait;
use Instagram\SDK\Support\Promise;
use Tebru\Gson\Annotation\JsonAdapter;
use function Instagram\SDK\Support\Promises\task;
use function Instagram\SDK\Support\Promises\unwrap;

/**
 * Class Thread
 *
 * @package            Instagram\SDK\DTO\Direct
 * @phan-file-suppress PhanUnextractableAnnotation, PhanPluginUnknownPropertyType, PhanUnreferencedUseNormal
 */
class Thread extends RequestIterator implements OnItemDecodeInterface
{

    use OnPropagateDecodeEventTrait;

    /**
     * @var string
     */
    private $threadId;

    /**
     * @var User[]
     */
    private $users = [];

    /**
     * @var User[]
     */
    private $leftUsers = [];

    /**
     * @var ThreadItem[]
     */
    private $items;

    /**
     * @var string
     */
    private $threadTitle;

    /**
     * @var double
     */
    private $lastActivityAt;

    /**
     * @var bool
     */
    private $muted;

    /**
     * @var bool
     */
    private $named;

    /**
     * @var bool
     */
    private $canonical;

    /**
     * @var bool
     */
    private $pending;

    /**
     * @var string
     */
    private $threadType;

    /**
     * @var int
     */
    private $viewerId;

    /**
     * @var bool
     */
    private $hasOlder;

    /**
     * @var bool
     */
    private $hasNewer;

    /**
     * @var LastSeenAtCollection<LastSeenAt>
     * @JsonAdapter("Instagram\SDK\DTO\Direct\Adapters\LastSeenAtAdapter")
     */
    private $lastSeenAt;

    /**
     * @var string
     */
    private $newestCursor;

    /**
     * @var string
     */
    private $oldestCursor;

    /**
     * Returns the thread items.
     *
     * @return ThreadItem[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return string
     */
    public function getThreadId()
    {
        return $this->threadId;
    }

    /**
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @return mixed
     */
    public function getLeftUsers()
    {
        return $this->leftUsers;
    }

    /**
     * @return mixed
     */
    public function getThreadTitle()
    {
        return $this->threadTitle;
    }

    /**
     * @return mixed
     */
    public function getLastActivityAt()
    {
        return $this->lastActivityAt;
    }

    /**
     * @return bool
     */
    public function isMuted(): bool
    {
        return $this->muted;
    }

    /**
     * @return bool
     */
    public function isNamed(): bool
    {
        return $this->named;
    }

    /**
     * @return bool
     */
    public function isCanonical(): bool
    {
        return $this->canonical;
    }

    /**
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->pending;
    }

    /**
     * @return mixed
     */
    public function getThreadType()
    {
        return $this->threadType;
    }

    /**
     * @return mixed
     */
    public function getViewerId()
    {
        return $this->viewerId;
    }

    /**
     * @return mixed
     */
    public function getHasOlder()
    {
        return $this->hasOlder;
    }

    /**
     * @return mixed
     */
    public function getHasNewer()
    {
        return $this->hasNewer;
    }

    /**
     * @return LastSeenAtCollection<LastSeenAt>
     */
    public function getLastSeenAt()
    {
        return $this->lastSeenAt;
    }

    /**
     * @return mixed
     */
    public function getNewestCursor()
    {
        return $this->newestCursor;
    }

    /**
     * @return mixed
     */
    public function getOldestCursor()
    {
        return $this->oldestCursor;
    }

    /**
     * @param mixed $threadId
     * @return $this
     */
    public function setThreadId($threadId)
    {
        $this->threadId = $threadId;

        return $this;
    }

    /**
     * @param User[] $users
     * @return $this
     */
    public function setUsers(array $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @param mixed $leftUsers
     * @return $this
     */
    public function setLeftUsers($leftUsers)
    {
        $this->leftUsers = $leftUsers;

        return $this;
    }

    /**
     * @param ThreadItem[] $items
     * @return $this
     */
    public function setItems(array $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @param mixed $threadTitle
     * @return $this
     */
    public function setThreadTitle($threadTitle)
    {
        $this->threadTitle = $threadTitle;

        return $this;
    }

    /**
     * @param mixed $lastActivityAt
     * @return $this
     */
    public function setLastActivityAt($lastActivityAt)
    {
        $this->lastActivityAt = $lastActivityAt;

        return $this;
    }

    /**
     * @param bool $muted
     * @return $this
     */
    public function setMuted(bool $muted)
    {
        $this->muted = $muted;

        return $this;
    }

    /**
     * @param bool $named
     * @return $this
     */
    public function setNamed(bool $named)
    {
        $this->named = $named;

        return $this;
    }

    /**
     * @param bool $canonical
     * @return $this
     */
    public function setCanonical(bool $canonical)
    {
        $this->canonical = $canonical;

        return $this;
    }

    /**
     * @param bool $pending
     * @return $this
     */
    public function setPending(bool $pending)
    {
        $this->pending = $pending;

        return $this;
    }

    /**
     * @param mixed $threadType
     * @return $this
     */
    public function setThreadType($threadType)
    {
        $this->threadType = $threadType;

        return $this;
    }

    /**
     * @param mixed $viewerId
     * @return $this
     */
    public function setViewerId($viewerId)
    {
        $this->viewerId = $viewerId;

        return $this;
    }

    /**
     * @param mixed $hasOlder
     * @return $this
     */
    public function setHasOlder($hasOlder)
    {
        $this->hasOlder = $hasOlder;

        return $this;
    }

    /**
     * @param mixed $hasNewer
     * @return $this
     */
    public function setHasNewer($hasNewer)
    {
        $this->hasNewer = $hasNewer;

        return $this;
    }

    /**
     * @param mixed $newestCursor
     * @return $this
     */
    public function setNewestCursor($newestCursor)
    {
        $this->newestCursor = $newestCursor;

        return $this;
    }

    /**
     * @param mixed $oldestCursor
     * @return $this
     */
    public function setOldestCursor($oldestCursor)
    {
        $this->oldestCursor = $oldestCursor;

        return $this;
    }

    /**
     * Retrieves the whole thread with thread items.
     *
     * @return bool|Promise<bool>
     */
    public function whole()
    {
        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType
        return task(function () {
            return $this->retrieveByCursor();
        })($this->client->getMode());
    }

    /**
     * Step forward and get the next items in thread.
     *
     * @return bool|Promise<bool>
     */
    public function next()
    {
        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType
        return task(function () {
            // Check whether there are any older posts
            if (!$this->getHasOlder()) {
                return false;
            }

            return $this->retrieveByCursor($this->oldestCursor);
        })($this->client->getMode());
    }

    /**
     * Step backward and get the previous items in thread.
     *
     * @return bool|Promise<bool>
     */
    public function rewind()
    {
        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType
        return task(function () {
            // Check whether there are any newer posts
            if (!$this->getHasNewer()) {
                return false;
            }

            return $this->retrieveByCursor($this->newestCursor);
        })($this->client->getMode());
    }

    /**
     * Sends a message to the thread.
     *
     * @param string $text
     * @phan-suppress PhanPluginMixedKeyNoKey
     * @return bool|Promise<bool>
     */
    public function sendMessage(string $text)
    {
        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType
        $promise = task(function () use ($text) {
            return $this->client->sendThreadMessage($text, $this->threadId);
        });

        // phpcs:ignore
        // @phan-suppress-next-line PhanPluginMixedKeyNoKey, PhanPluginUnknownClosureReturnType, PhanPluginUnknownClosureParamType
        return $promise->then(function ($promise) use ($text) {
            /** @var DirectSendItemMessage $message */
            $message = unwrap($promise);

            // Check if the message was successful
            if (!$message->isSuccess()) {
                return false;
            }

            // Build the thread item
            $item = ThreadItem::create([
                // @phan-suppress-next-line PhanPluginMixedKeyNoKey
                'itemType' => ItemType::TEXT,
                'user'     => $this->getSender(),
                'text'     => $text,
                $message->getPayload(),
            ]);

            $this->items[] = $item;

            return true;
        })($this->client->getMode());
    }

    /**
     * Sets the thread, or thread id as seen.
     *
     * @param string|null $threadItemId
     * @return SeenMessage|Promise<SeenMessage>
     */
    public function seen(?string $threadItemId = null)
    {
        /**
         * @var ThreadItem $latestItem
         */
        $latestItem = current($this->items);

        return $this->client->seen($this->threadId, $threadItemId ?? $latestItem->getItemId());
    }

    /**
     * Refresh the thread with the latest updates.
     *
     * @suppress PhanPluginUnknownClosureReturnType
     * @return bool|Promise<bool>
     */
    public function refresh()
    {
        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType
        return task(function () {
            return $this->retrieveByCursor();
        })($this->client->getMode());
    }

    /**
     * Retrieve thread items by cursor.
     *
     * @param string|null $cursor
     * @return bool|Promise<bool>
     */
    protected function retrieveByCursor(?string $cursor = null)
    {
        // Query for thread items by cursor
        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType
        $promise = task(function () use ($cursor) {
            return $this->client->thread($this->threadId, $cursor);
        });

        // @phan-suppress-next-line PhanPluginUnknownClosureReturnType, PhanPluginUnknownClosureParamType
        return $promise->then(function ($promise) {
            /** @var ThreadMessage $message */
            $message = unwrap($promise);

            // Check if we successfully retrieved additional thread items
            if (!$message->isSuccess()) {
                return false;
            }

            // Retrieve the thread
            $thread = $message->getThread();

            $this->setNewestCursor($thread->getNewestCursor())
                ->setOldestCursor($thread->getOldestCursor())
                ->setItems($thread->getItems())
                ->setHasOlder($thread->getHasOlder())
                ->setHasNewer($thread->getHasNewer());

            return true;
        })($this->client->getMode());
    }

    /**
     * Returns unseen items for the user.
     *
     * @param int|null $userId
     * @return ThreadItem[]
     */
    public function getUnseenItems(?int $userId = null): array
    {
        $userId = $userId ?? $this->viewerId;

        if (($lastSeenAtForUser = $this->lastSeenAt->get($userId)) === null) {
            return [];
        }

        $result = [];

        foreach ($this->items as $item) {
            if ($item->getTimestamp() <= (float)$lastSeenAtForUser->getTimestamp()) {
                continue;
            }

            $result[] = $item;
        }

        return $result;
    }

    /**
     * On item decode method.
     *
     * @suppress PhanUnusedPublicMethodParameter
     * @suppress PhanPossiblyNullTypeMismatchProperty
     * @param array<string, mixed>  $container
     */
    public function onDecode(array $container): void
    {
        $this->client = $container['client'];

        $this->propagate($container);
    }

    /**
     * Returns the sender.
     *
     * @return \Instagram\SDK\DTO\Session\User
     */
    protected function getSender()
    {
        return $this->client->getSession()->getUser();
    }
}
